<?php

namespace App\Http\Controllers\API;

use App\bill;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use DB;
use Carbon\Carbon;
use App\notification;
use App\setting;
use App\contact;
use App\slider;
use App\item;
use App\item_image;
use App\member;
use App\City;
use App\comment;
use App\commission;
use App\country;
use App\District;
use App\maincategory;
use App\report;
use App\comment_report;
use App\transfer;
use Settings;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Facades\FCM;

class appsettingController  extends BaseController
{
    public function settingindex(Request $request)
    {

        $jsonarr              = array();
        $setting              = setting::all();
        $jsonarr['info']      = $setting;
        return $this->sendResponse('success', $jsonarr);
    }

    public function countries(Request $request)
    {
        $countryinfo = array();
        $countries = country::all();
        foreach ($countries as $country) {
            $cities = City::where('country_id', $country->id)->get();
            array_push(
                $countryinfo,
                array(
                    "country_id"      => $country->id,
                    "country_name"      => $country->name,
                    "cities"      => $cities,
                )
            );
        }
        return $this->sendResponse('success', $countryinfo);
    }

    public function contactus(Request $request)
    {
        $newcontact          = new contact();
        $newcontact->name    = $request->name;
        $newcontact->message = $request->message;
        $newcontact->save();
        $errormessage =  'تم ارسال الرسالة بنجاح';
        return $this->sendResponse('success', $errormessage);
    }

    public function makereport(Request $request)
    {
        $user= member::where('id',$request->user_id)->first();
        $item = item::where('id',$request->ad_num)->first();
        if($user && $item ){
        $newreport         = new report;
        $newreport->ad_num    = $request->ad_num;
        $newreport->message = $request->message;
        $newreport->user_id = $request->user_id;
        $newreport->save();
        $errormessage =  'تم ارسال البلاغ بنجاح';
        return $this->sendResponse('success', $errormessage);
        }else{
            $errormessage =  'هذا المنتج غير موجود';
        return $this->sendError('success', $errormessage);
        }
    }
    
    public function makereport_comment(Request $request)
    {
        $user= member::where('id',$request->user_id)->first();
        $comment = comment::where('id',$request->com_id)->first();
        if($user && $comment ){
        $newreport         = new comment_report;
        $newreport->com_id   = $request->com_id;
        $newreport->message = $request->message;
        $newreport->user_id = $request->user_id;
        $newreport->save();
        $errormessage =  'تم ارسال البلاغ بنجاح';
        return $this->sendResponse('success', $errormessage);
        }else{
            $errormessage =  'هذا التعليق غير موجود';
        return $this->sendError('success', $errormessage);
        }
    }



    public function home(Request $request)
    {
        $topsliders      = array();
        $maincategories  = array();
        $listitems       = array();
        $cities          = array();
        $current         = array();


        //top sliders
        $sliders = slider::where('suspensed', 0)->orderBy('id', 'desc')->get();
        foreach ($sliders as $slider) {
            array_push(
                $topsliders,
                array(
                    "id"      => $slider->id,
                    'image'   => $slider->image,
                    'title'   => $slider->artitle,
                    'url'    => $slider->url,
                    'text'    => $slider->text,
                )
            );
        }

        //main categories
        $categories = maincategory::all();
        foreach ($categories as $category) {
            array_push(
                $maincategories,
                array(
                    "id"      => $category->id,
                    "name"    => $category->name,
                    'image'   => $category->image,
                )
            );
        }

        //list items
       
        
        $items = item::where('suspensed',0)->orderBy('id', 'desc')->get();


        foreach ($items as $item) {
            $image     = item_image::where('item_id', $item->id)->first();
            if($image){
                $image_name = $image->image ;
            }else{
                $image_name= null;
            }
            $user = member::where('id', $item->user_id)->first();
            $city = City::where('id', $item->city_id)->first();
            $country = country::where('id', $item->country_id)->first();
            $favorited = 0;
            $humantime  = 'منذ '.Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans(null,true,true);
             $arhumantime = str_replace(
        array('0','1','2','3','4','5','6','7','8','9'),
        array('٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'),
        $humantime
        );
        
             
            if ($request->user_id) {
                $fav = DB::table('favorite_items')->where('user_id', $request->user_id)->where('item_id', $item->id)->get();
                $favorited = count($fav) != 0 ? 1 : 0;
            }
            array_push(
                $listitems,
                array(
                    "id"           => $item->id,
                    'image'        => $image_name,
                    'title'        => $item->artitle,
                    'price'        => $item->price,
                    'details'      => $item->details,
                    'favorited'    => $favorited,
                    'ownername'    => $user->name,
                    'country'    => $country->name,
                    'city'    => $city->name,
                    'created_at'    => $humantime,
                )
            );
        }

        $allcities = City::orderBy('id', 'desc')->get();

        foreach ($allcities as $city) {
            array_push($cities, array(
                "id"  => $city->id,
                "name" => $city->name,
            ));
        }

        $countries = country::orderBy('id', 'desc')->get();
        $allcountries = array();
        foreach ($countries as $country) {
            $city =  City::where('country_id', $country->id)->get();

            array_push($allcountries, array(
                "country"  => $country,
                "cities" => $city
            ));
        }
        $current['topsliders']     = $topsliders;
        $current['categories']     = $maincategories;
        $current['cities']         = $cities;
        $current['countries']      = $allcountries;
        $current['listitems']      = $listitems;
        return $this->sendResponse('success', $current);
    }

    public function addtransfer(Request $request)
    {
        $user = member::where('id', $request->user_id)->first();
        if ($user) {

            $newbill = new bill();
            $newbill->user_id = $user->id;
            $newbill->category          = $request->category;
            $newbill->ad_num         = $request->ad_num;
            $newbill->buyer         = $request->buyer;
            $newbill->count         = $request->count;
            $newbill->price         = $request->price;
            $newbill->bill_number   = date('dmY') . rand(0, 999);

            $newbill->save();

            $newtransfer                = new transfer();
            $newtransfer->user_id          = $user->id;
            $newtransfer->bank_name         = $request->bank_name;
            $newtransfer->bill_number         = $newbill->bill_number;

            if ($request->hasFile('image')) {
                $image    = $request['image'];
                $filename = rand(0, 9999) . '.' . $image->getClientOriginalExtension();
                $image->move(base_path('users/images/'), $filename);
                $newtransfer->image = $filename;
            }
            $newtransfer->save();


            $notification                = new notification();
            $notification->user_id       = $request->user_id;
            $notification->notification  = 'تم إرسال التحويل بنجاح';
            $notification->save();

            $usertoken = member::where('id', $request->user_id)->where('firebase_token', '!=', null)->where('firebase_token', '!=', 0)->value('firebase_token');
            if ($usertoken) {
                $optionBuilder = new OptionsBuilder();
                $optionBuilder->setTimeToLive(60 * 20);

                $notificationBuilder = new PayloadNotificationBuilder('تم إرسال التحويل بنجاح');
                $notificationBuilder->setBody($request->notification)
                    ->setSound('default');

                $dataBuilder = new PayloadDataBuilder();
                $dataBuilder->addData(['a_type' => 'message']);
                $option       = $optionBuilder->build();
                $notification = $notificationBuilder->build();
                $data         = $dataBuilder->build();
                $token        = $usertoken;

                $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

                $downstreamResponse->numberSuccess();
                $downstreamResponse->numberFailure();
                $downstreamResponse->numberModification();
                $downstreamResponse->tokensToDelete();
                $downstreamResponse->tokensToModify();
                $downstreamResponse->tokensToRetry();
            }
            $errormessage = 'تم ارسال التحويل بنجاح';
            return $this->sendResponse('success', $errormessage);
        } else {
            $errormessage = 'هذا المستخدم غير موجود';
            return $this->sendResponse('success', $errormessage);
        }
    }

    public function commissions(Request $request)
    {
        $commissions = commission::all();
        $allcommissions= array();
    foreach ($commissions as $commission) {
        $category = maincategory::where('id',$commission->category_id)->first();
            array_push($allcommissions, array(
                "category_id"  => $category->id,
                "category_name" => $category->name,
                "commission" => $commission->commission,
            ));
        }
        $setting = setting::first();
        $current['commissions']=$allcommissions;
    $current['commission_text']=$setting->commission_text;
        return $this->sendResponse('success', $current);
    }
}
