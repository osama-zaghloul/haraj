<?php

namespace App\Http\Controllers\API;

use App\bill;
use App\City;
use App\country;
use App\Http\Controllers\API\BaseController as BaseController;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\member;
use App\order;
use App\item;
use App\item_image;
use App\notification;
use App\favorite_item;
use App\maincategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;
use DB;
use App\like;
use App\blacklist;



class userController extends BaseController
{
    //registeration process 
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'           => 'required',
                'phone'          => 'required|unique:members',
                'country_id'        => 'required',
                'city_id'        => 'required',
                'password'       => 'required|min:6',
            ],
            [
                'name.required'         => 'هذا الحقل مطلوب',
                'phone.required'        => 'هذا الحقل مطلوب',
                'phone.unique'          => 'تم اخذ هذا الهاتف سابقا',
                'country_id.required'        => 'هذا الحقل مطلوب',
                'city_id.required'        => 'هذا الحقل مطلوب',
                'password.required'     => 'هذا الحقل مطلوب',
                'password.min'          => 'كلمة المرور لا تقل عن 6 احرف',
            ]
        );

        if ($validator->fails()) {
            return $this->sendError('success', $validator->errors());
        }

        $newmember                 = new member;
        $newmember->name           = $request['name'];
        $newmember->phone          = $request['phone'];
        $newmember->country_id          = $request['country_id'];
        $newmember->city_id        = $request['city_id'];
        $newmember->password       = Hash::make($request['password']);
        $newmember->firebase_token = $request['firebase_token'];
        $newmember->connect = now();
        $newmember->save();
        $reguser = member::find($newmember->id);

        $notification                = new notification();
        $notification->user_id       = $newmember->id;
        $notification->notification  = 'تم تسجيل حسابك بنجاح';
        $notification->save();
        
        $country = country::where('id', $request->country_id)->first();
        $city = city::where('id', $request->city_id)->first();
        $reguser->country_name=$country->name;
        $reguser->city_name=$city->name;
        return $this->sendResponse('success', $reguser);
    }

    //Login process
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'password'       => 'required',
        ], [
            'name.required' => 'هذا الحقل مطلوب',
            'password.required'     => 'هذا الحقل مطلوب',
        ]);


        if ($validator->fails()) {
            return $this->sendError('success', $validator->errors());
        }

        if (Auth::attempt(['name' => $request->name, 'password' => $request->password, 'suspensed' => 0])) {
            $user                 = Auth::user();
            $user->firebase_token = $request->firebase_token;
            $user->connect = now();
            $user->save();
            
                $country = country::where('id', $user->country_id)->first();
                $city = city::where('id', $user->city_id)->first();
                $user->country_name=$country->name;
                $user->city_name=$city->name;
            return $this->sendResponse('success', $user);
        } else {
            $errormessage = 'اسم المستخدم أو كلمة المرور غير صحيحة';
            return $this->sendError('success', $errormessage);
        }
    }

    //forgetpassword process
    public function forgetpassword(Request $request)
    {
        $user = member::where('phone', $request->phone)->first();
        if (!$user) {
            $errormessage = ' رقم الهاتف غير صحيح';
            return $this->sendError('success', $errormessage);
        } else {
            $randomcode        = substr(str_shuffle("0123456789"), 0, 4);
            $user->forgetcode  = $randomcode;
            $user->save();

            return $this->sendResponse('success', $user->forgetcode);
        }
    }

    public function activcode(Request $request)
    {
        $user = member::where('phone', $request->phone)->where('forgetcode', $request->forgetcode)->first();
        if ($user) {
            return $this->sendResponse('success', 'true');
        } else {
            $errormessage = ' الكود غير صحيح';
            return $this->sendError('success', $errormessage);
        }
    }

    //rechangepassword process
    public function rechangepass(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'new_password'    => 'required',
            ]
        );

        if ($validator->fails()) {
            return $this->sendError('success', $validator->errors());
        }

        $user = member::where('phone', $request->phone)->first();
        if ($user) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            $errormessage = 'تم تغيير كلمة المرور بنجاح';
            return $this->sendResponse('success', $errormessage);
        } else {
            $errormessage = 'هذا الهاتف غير صحيح';
            return $this->sendError('success', $errormessage);
        }
    }

    //profile process
    public function profile(Request $request)
    {
        $user = member::where('id', $request->user_id)->where('suspensed', 0)->first();
        if (!$user) {
            $errormessage = 'هذا المستخدم غير موجود';
            return $this->sendError('success', $errormessage);
        } else {
            return $this->sendResponse('success', $user);
        }
    }

    //updating profile process
   public function update(Request $request)
    {
        $upuser = member::where('id', $request->user_id)->first();
        if ($upuser) {


            $validator = Validator::make(
                $request->all(),
                [
                    'name'           => 'required',
                    'phone'          => 'required|unique:members,phone,' . $upuser->id,
                    'country_id'        => 'required',
                    'city_id'        => 'required',
                    'password'       => 'required|min:6',
                ],
                [
                    'name.required'         => 'هذا الحقل مطلوب',
                    'phone.required'        => 'هذا الحقل مطلوب',
                    'phone.unique'          => 'تم اخذ هذا الهاتف سابقا',
                    'country_id.required'        => 'هذا الحقل مطلوب',
                    'city_id.required'        => 'هذا الحقل مطلوب',
                    'password.required'     => 'هذا الحقل مطلوب',
                    'password.min'          => 'كلمة المرور لا تقل عن 6 احرف',
                ]
            );



            if ($validator->fails()) {
                return $this->sendError('success', $validator->errors());
            }

            $upuser->name           = $request['name'];
            $upuser->phone          = $request['phone'];
            $upuser->country_id          = $request['country_id'];
            $upuser->city_id        = $request['city_id'];
            $upuser->password       = Hash::make($request['password']);
            $upuser->firebase_token = $request['firebase_token'];
            $upuser->connect = now();
            $upuser->save();
            $upuser['message'] = ' تم تعديل حسابك بنجاح';

            $notification                = new notification();
            $notification->user_id       = $upuser->id;
            $notification->notification  = 'تم تعديل حسابك بنجاح';
            $notification->save();
            return $this->sendResponse('success', $upuser);
        } else {
            $errormessage = 'هذا المستخدم غير موجود';
            return $this->sendError('success', $errormessage);
        }
    }

    public function mynotification(Request $request)
    {
        DB::table('notifications')->where('user_id', $request->user_id)->update(['readed' => 1]);
        $mynotifs = notification::where('user_id', $request->user_id)->orderBy('id', 'desc')->get();
        if (count($mynotifs) != 0) {
            return $this->sendResponse('success', $mynotifs);
        } else {
            $errormessage = 'لا يوجد تنبيهات';
            return $this->sendError('success', $errormessage);
        }
    }

    public function deletenotification(Request $request)
    {
        $notification = DB::table('notifications')->where('user_id', $request->user_id)->where('id', $request->notification_id);
        $notification->delete();
        $errormessage = 'تم حذف الاشعار';
        return $this->sendResponse('success', $errormessage);
    }



    public function myfavoriteitems(Request $request)
    {
        $favitems  = favorite_item::where('user_id', $request->user_id)->orderBy('id', 'desc')->get();
        if (count($favitems) == 0) {
            $errormessage = 'لا يوجد منتجات ف المفضلة';
            return $this->sendError('success', $errormessage);
        } else {
            foreach ($favitems as $item) {
                $allfavads[] = item::where('id', $item->item_id)->first();
            }

            $currentitems = array();
            foreach ($allfavads as $item) {
                $image     = item_image::where('item_id', $item->id)->first();
                $user     = member::where('id', $item->user_id)->first();
                $country     = country::where('id', $item->country_id)->first();
                $city     = City::where('id', $item->city_id)->first();
                $humantime  = Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans(null,true,true).' ago';

                $favorited = 0;


                $fav = DB::table('favorite_items')->where('user_id', $request->user_id)->where('item_id', $item->id)->get();
                $favorited = count($fav) != 0 ? 1 : 0;

                array_push(
                    $currentitems,
                    array(
                        "id"              => $item->id,
                        'image'           => $image,
                        'title'           => $item->artitle,
                        'country'           => $country->name,
                        'city'           => $city->name,
                        "owner"        => $user->name,
                        "created_at"         => $humantime,
                        'favorited'       => $favorited,
                    )
                );
            }
            return $this->sendResponse('success', $currentitems);

            return $this->sendResponse('success', $allfavads);
        }
    }

    public function updatefirebasebyid(Request $request)
    {
        $user = member::where('id', $request->user_id)->first();
        if ($user) {
            $user->firebase_token = Hash::make($request->firebase_token);
            $user->save();
            $errormessage = 'تم التحديث';
            return $this->sendResponse('success', $errormessage);
        } else {
            $errormessage = 'هذا المستخدم غير موجود';
            return $this->sendError('success', $errormessage);
        }
    }
    //add like
    public function addlike(Request $request)
    {

        $user = member::where('id', $request->user_id)->first();
        $trader = member::where('id', $request->trader_id)->first();
        if ($user && $trader) {


            $like = like::where('user_id', $request->user_id)->where('trader_id', $request->trader_id)->first();
            if ($like) {
                $trader = member::where('id', $request->trader_id)->first();
                $like->delete();
                $trader->likes -= 1;
                $trader->save();
                $errormessage = 'تم حذف اللايك  لهذا التاجر  ';
                return $this->sendResponse('success', $errormessage);
            } else {


                $newlike = new like();
                $newlike->user_id = $request->user_id;
                $newlike->trader_id = $request->trader_id;
                $newlike->save();

                $trader->likes += 1;
                $trader->save();
                $errormessage = 'تم إضافة لايك لهذا التاجر  ';
                return $this->sendResponse('success', $errormessage);
            }
        } else {
            $errormessage = 'هذا التاجر أو المستخدم غير موجود';
            return $this->sendError('success', $errormessage);
        }
    }
    
    

    //changepassword process
    public function changepassword(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'new_password'    => 'required',
            ]
        );

        if ($validator->fails()) {
            return $this->sendError('success', $validator->errors());
        }

        $user = member::where('phone', $request->phone)->first();
        if ($user) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            $errormessage = 'تم تغيير كلمة المرور بنجاح';
            return $this->sendResponse('success', $errormessage);
        } else {
            $errormessage = 'هذا العضو غير موجود';
            return $this->sendError('success', $errormessage);
        }
    }


    public function showuser(Request $request)
    {
        $trader = member::find($request->trader_id);
        
        if ($trader) {
            $user = member::where('id',$request->user_id)->first();
            if($user){
                $like = like::where('user_id',$request->user_id)->where('trader_id',$request->trader_id)->first();
                if($like){
                    $liked = 1;
                }else{
                    $liked = 0;
                }
            }else{
                $liked= 0;
            }
            $userinfo     = array();
            $iteminfo     = array();
            $created_at  = Carbon::createFromTimeStamp(strtotime($trader->created_at))->diffForHumans();
            $connect  = Carbon::createFromTimeStamp(strtotime($trader->connect))->diffForHumans();
            $items = item::where('user_id', $trader->id)->where('suspensed', 0)->get();
            foreach ($items as $item) {
                $category = maincategory::where('id', $item->category_id)->first();
                $country = country::where('id', $item->country_id)->first();
                $city = City::where('id', $item->city_id)->first();
                $image   = item_image::where('item_id', $item->id)->first();
                $humantime  = 'منذ '.Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans(null,true,true);
                $arhumantime = str_replace(
                array('0','1','2','3','4','5','6','7','8','9'),
                array('٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'),
                $humantime
                );
                array_push(
                    $iteminfo,
                    array(
                        "id"               => $item->id,
                        "title"          => $item->artitle,
                        "code"          => (string)$item->id,
                        "username"       => $trader->name,
                        "created_at"    => $humantime,
                        "country"            => $country->name,
                        "city"            => $city->name,
                        "image"            => $image,
                    )
                );
            }


            array_push(
                $userinfo,
                array(
                    "id"              => $trader->id,
                    'name'           => $trader->name,
                    "last_seen"           => $connect,
                    "created_at"       => $created_at,
                    "likes"        => $trader->likes,
                    "liked"        => $liked,
                    "items"        => $iteminfo,


                )
            );

            return $this->sendResponse('success', $userinfo);
        } else {
            $errormessage = 'المستخدم غير موجود';
            return $this->sendError('success', $errormessage);
        }
    }

    public function bills(Request $request)
    {
        $user = member::find($request->user_id);
        if ($user) {
            $bills = bill::where('user_id', $user->id)->get();
            if (count($bills) > 0) {
                $allbills = array();
                foreach($bills as $bill){
                    array_push(
                $allbills,
                array(
                    "id"              => $bill->id,
                    'bill_number'           => $bill->bill_number,
                    'ad_num'           => $bill->ad_num,
                    "price"           => $bill->price,
                    "category"       => $bill->category,
                    "buyer"        => $bill->buyer,
                    "count"        => $bill->count,
                    "trader_id"        => $user->id,
                    "trader"        => $user->name,
                    "created_at"        => $bill->created_at,
                    


                )
            );
                }
                return $this->sendResponse('success', $allbills);
            } else {
                $errormessage = ' لا يوجد فواتير ';
                return $this->sendError('success', $errormessage);
            }
        } else {
            $errormessage = 'المستخدم غير موجود';
            return $this->sendError('success', $errormessage);
        }
    }
    public function showbill(Request $request)
    {
        $bill = bill::find($request->bill_id);
        if ($bill) {

            return $this->sendResponse('success', $bill);
        } else {
            $errormessage = ' هذه الفاتورة غير موجودة  ';
            return $this->sendError('success', $errormessage);
        }
    }
    
    public function blacklist(Request $request)
    {
        $item = item::where('id',$request->data)->first();
        if($item){
            $user = member::where('id',$item->user_id)->first();
        }else{
            $user = member::where('phone',$request->data)->first();
        }
        
        if($user){
        
        $list = blacklist::where('user_id',$user->id)->first();
        if ($list) {
            $list['msg']= 'هذا العضو موجود في القائمة السوداء';
            $list['user']=$user;
            
            return $this->sendResponse('success', $list);
        } else {
            $errormessage = 'هذا العضو غير موجود بالقائمة السوداء';
            return $this->sendError('success', $errormessage);
        }
        }else{
            $errormessage ='من فضلك أدخل رقم هاتف أو رقم منتج متاح';
            return $this->sendError('success', $errormessage);
        }
    }
}
