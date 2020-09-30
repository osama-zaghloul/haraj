<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\API\BaseController as BaseController;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\chat;
use App\notification;
use Carbon\Carbon;
use App\member;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use DB;

class chatController extends BaseController
{
    //Chatting process 
    public function makechat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            $errorarr = array();
            return $this->sendError($errorarr, $validator->errors());
        }

        $user  = chat::create($request->all());
        $user->msg_date = now();
        $user->save();
        $sendername    = member::where('id', $user->sender_id)->first();
        $reciver_token = member::where('id', $user->receiver_id)->first();
        if ($reciver_token) {
            $notification                = new notification();
            $notification->user_id       = $user->receiver_id;
            $notification->notification  = ' رسالة جديدة من ' . $sendername->name;
            $notification->save();

            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60 * 20);

            $notificationBuilder = new PayloadNotificationBuilder(' رسالة جديدة من ' . $sendername->name);
            $notificationBuilder->setBody($user->message)
                ->setSound('default');

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['a_type' => 'message']);
            $dataBuilder->addData(['user_id' => $user->sender_id]);
            $dataBuilder->addData(['user_name' => $sendername->name]);
            $dataBuilder->addData(['msg_date' => $user->msg_date]);
            $dataBuilder->addData(['message' => $user->message]);
            $dataBuilder->addData(['message_id' => $user->id]);
            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();
            $token = $reciver_token->firebase_token;

            $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

            $downstreamResponse->numberSuccess();
            $downstreamResponse->numberFailure();
            $downstreamResponse->numberModification();
            $downstreamResponse->tokensToDelete();
            $downstreamResponse->tokensToModify();
            $downstreamResponse->tokensToRetry();
        }

        return $this->sendResponse('success', 'Message Sent Successfully');
    }

    //getchaters
    public function getchaters(Request $request)
    {
        if (!$request->user_id) {
            $errorarr = array();
            return $this->sendError($errorarr, 'Not Found');
        }

        $allchaters  = chat::where('sender_id', $request->user_id)->orwhere('receiver_id', $request->user_id)->get();
        if (count($allchaters) > 0) {
            $userids     = array();
            foreach ($allchaters as $all) {
                $userid = $all->sender_id == $request->user_id ? $all->receiver_id : $all->sender_id;
                if (!in_array($userid, $userids)) {
                    array_push($userids, $userid);
                }
            }

            foreach ($userids as $id) {
                $chatinfo   = chat::where('sender_id', $id)->orwhere('receiver_id', $id)->latest('id')->first();
                $user       = DB::table('members')->where('id', $id)->first();
                $humantime  = Carbon::createFromTimeStamp(strtotime($chatinfo->msg_date))->diffForHumans();
                $userinfo[] = array(
                    'id' => $id,
                    'name' => $user->name,
                    //  'image' => $user->image,
                    'last_message' => $chatinfo->message,
                    'created_at'   => $humantime,
                );
            }

            return $this->sendResponse('success', $userinfo);
        } else {
            return $this->sendResponse('success', 'لا توجد محادثات');
        }
    }


    //get all messages of chat
    public function getchat(Request $request)
    {
        $chatinfo = array();
        $chatcont1 = chat::where('sender_id', $request->sender_id)->where('receiver_id', $request->receiver_id)->get();
        $chatcont2 = chat::where('sender_id', $request->receiver_id)->where('receiver_id', $request->sender_id)->get();
        $all = $chatcont1->merge($chatcont2);
        $all = array_values(array_sort($all, function ($value) {
            return -$value['id'];
        }));

        foreach ($all as $info) {
            $sendername = DB::table('members')->where('id', $info->sender_id)->first();
            $receivername = DB::table('members')->where('id', $info->receiver_id)->first();
            array_push(
                $chatinfo,
                array(
                    "id" => $info->id,
                    "message" => $info->message,
                    "sender_id" => $info->sender_id,
                    "sendername" => $sendername->name,
                    "receiver_id" => $info->receiver_id,
                    "receivername" => $receivername->name,
                    "msg_date" => $info->msg_date
                )
            );
        }
        return $this->sendResponse('success', $chatinfo);
    }
}