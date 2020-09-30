<?php

namespace App\Http\Controllers\API;

use App\City;
use App\comment;
use App\country;
use App\Http\Controllers\API\BaseController as BaseController;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\Mail\activationmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\notification;
use App\item;
use App\item_image;
use App\report;
use App\favorite_item;
use App\maincategory;
use App\order;
use App\member;
use Categories;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;


class itemController extends BaseController
{
    

    public function makeitem(Request $request)
    {

        $user = member::where('id', $request->user_id)->first();
        if ($user) {

            $validator = Validator::make(
                $request->all(),
                [

                    
                    'category_id'        => 'required',
                    'price'        => 'required',
                    'details'       => 'required',
                    'artitle'       => 'required',
                    'country_id'       => 'required',
                    'city_id'       => 'required',
                ],
                [
                    'price.required'         => 'هذا الحقل مطلوب',
                    'category_id.required'        => 'هذا الحقل مطلوب',
                    'country_id.required'     => 'هذا الحقل مطلوب',
                    'city_id.required'     => 'هذا الحقل مطلوب',
                    'artitle.required'     => 'هذا الحقل مطلوب',
                    'details.required'     => 'هذا الحقل مطلوب',

                ]
            );

            if ($validator->fails()) {
                return $this->sendError('success', $validator->errors());
            }

            $newitem   = new item();
            $newitem->code  = date('dmY') . rand(0, 99);
            $newitem->user_id  = $request->user_id;
            $newitem->country_id  = $request->country_id;
            $newitem->city_id  = $request->city_id;
            $newitem->artitle  = $request->artitle;
            $newitem->category_id  = $request->category_id;
            $newitem->details  = $request->details;
            $newitem->price  = $request->price;
            if($request->phone){
            $newitem->phone  = $request->phone;
            }
            if($request->whatsapp){
            $newitem->whatsapp  = $request->whatsapp;
            }
            if ($request->hasFile('video')) {
                // $playtime_seconds = $file['playtime_seconds'];
                $video    = $request->video;
                $filename = rand(0, 9999) . '.' . $video->getClientOriginalExtension();
                $video->move(base_path('users/videos/'), $filename);
                $newitem->video = $filename;
            }
            $newitem->save();

           
            if ($request->hasFile('imagesarr')) {
                $images = $request['imagesarr'];
                if($images){
                    foreach ($images as $image) {
                        $newimg = new item_image;
                        $img_name = rand(0, 999) . '.' . $image->getClientOriginalExtension();
                        $image->move(base_path('users/images/'), $img_name);
                        $newimg->image   = $img_name;
                        $newimg->item_id = $newitem->id;
                        $newimg->save();
                    }
                 }
            }

            return $this->sendResponse('success', 'تم إضافة المنتج بنجاح');
        } else {
            $errormessage = 'المستخدم غير موجود';
            return $this->sendError('success', $errormessage);
        }
    }


    public function upitem(Request $request)
    {

        $upitem = item::where('id', $request->item_id)->first();
        if ($upitem) {

            $user = member::where('id', $request->user_id)->first();
            if ($user) {
                $validator = Validator::make(
                    $request->all(),
                    [

                        'phone'          => 'required',
                        'category_id'        => 'required',
                        'price'        => 'required',
                        'whatsapp'       => 'required',
                        'details'       => 'required',
                        'artitle'       => 'required',
                        'country_id'       => 'required',
                        'city_id'       => 'required',
                    ],
                    [
                        'price.required'         => 'هذا الحقل مطلوب',
                        'phone.required'        => 'هذا الحقل مطلوب',
                        'category_id.required'        => 'هذا الحقل مطلوب',
                        'whatsapp.required'        => 'هذا الحقل مطلوب',
                        'country_id.required'     => 'هذا الحقل مطلوب',
                        'city_id.required'     => 'هذا الحقل مطلوب',
                        'artitle.required'     => 'هذا الحقل مطلوب',
                        'details.required'     => 'هذا الحقل مطلوب',

                    ]
                );

                if ($validator->fails()) {
                    return $this->sendError('success', $validator->errors());
                }


                // $upitem->code  = $request->code;
                $upitem->user_id  = $request->user_id;
                $upitem->country_id  = $request->country_id;
                $upitem->city_id  = $request->city_id;
                $upitem->artitle  = $request->artitle;
                $upitem->category_id  = $request->category_id;
                $upitem->details  = $request->details;
                $upitem->price  = $request->price;
                $upitem->phone  = $request->phone;
                $upitem->whatsapp  = $request->whatsapp;
                if ($request->hasFile('video')) {
                    // $playtime_seconds = $file['playtime_seconds'];
                    $video    = $request->video;
                    $filename = rand(0, 9999) . '.' . $video->getClientOriginalExtension();
                    $video->move(base_path('users/videos/'), $filename);
                    $upitem->video = $filename;
                }
                $upitem->save();

                //update images
                
                 if ($request->hasFile('imagesarr')) {
                $images = $request['imagesarr'];
                if($images){
                    foreach ($images as $image) {
                        $newimg = new item_image;
                        $img_name = rand(0, 999) . '.' . $image->getClientOriginalExtension();
                        $image->move(base_path('users/images/'), $img_name);
                        $newimg->image   = $img_name;
                        $newimg->item_id = $upitem->id;
                        $newimg->save();
                      }
                   }
                }


                return $this->sendResponse('success', 'تم تعديل المنتج بنجاح');
            } else {
                $errormessage = 'المستخدم غير موجود';
                return $this->sendError('success', $errormessage);
            }
        } else {
            $errormessage = 'المنتج غير موجود';
            return $this->sendError('success', $errormessage);
        }
    }
    
    public function showitem(Request $request)
    {
        $showitem = item::find($request->item_id);
        if ($showitem) {
            $iteminfo     = array();
            $commentinfo     = array();


            $images    = item_image::where('item_id', $showitem->id)->get();
            $user = member::where('id', $showitem->user_id)->first();
            $category = maincategory::where('id', $showitem->category_id)->first();
            $country = country::where('id', $showitem->country_id)->first();
            $city = City::where('id', $showitem->city_id)->first();
            $humantime  = 'منذ '.Carbon::createFromTimeStamp(strtotime($showitem->created_at))->diffForHumans(null,true,true);
            
             $arhumantime = str_replace(
                array('0','1','2','3','4','5','6','7','8','9'),
                array('٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'),
                $humantime
                );
            $favorited = 0;
            if ($request->user_id) {
                $fav = DB::table('favorite_items')->where('user_id', $request->user_id)->where('item_id', $showitem->id)->get();
                $favorited = count($fav) != 0 ? 1 : 0;
            }

            $comments = comment::where('item_id', $request->item_id)->get();
            foreach ($comments as $comment) {
                $com_user = member::where('id', $comment->user_id)->first();
                array_push(
                    $commentinfo,
                    array(
                        "id"               => $comment->id,
                        "content"          => $comment->content,
                        "created_at"       => $comment->created_at,
                        "comment_owner"    => $com_user->name,
                        "comment_owner_id"    => $com_user->id,
                        "count"            => count($comments),
                    )
                );
            }


            array_push(
                $iteminfo,
                array(
                    "id"              => $showitem->id,
                    'title'           => $showitem->artitle,
                    "price"           => $showitem->price,
                    "code"            => (string)$showitem->id,
                    "category_id"        => $category->id,
                    "category"        => $category->name,
                    "owner_id"           => $user->id,
                    "owner"           => $user->name,
                    "country_id"         => $country->id,
                    "country"         => $country->name,
                    "city_id"         => $city->id,
                    "city"         => $city->name,
                    "whatsapp"        => $showitem->whatsapp,
                    "phone"           => $showitem->phone,
                    "details"         => $showitem->details,
                    "video"           => $showitem->video,
                    'created_at'      => $humantime,
                    'favorited'       => $favorited,
                    'images'          => $images,
                    'commentinfo'     => $commentinfo,
                )
            );

            return $this->sendResponse('success', $iteminfo);
        } else {
            $errormessage = 'المنتج غير موجود';
            return $this->sendError('success', $errormessage);
        }
    }
    
    public function makecomment(Request $request)
    {
        
        $newcomment = new comment();
        $newcomment->user_id = $request->user_id;
        $newcomment->item_id = $request->item_id;
        $newcomment->content = $request->content;
        $newcomment->save();
       
        $res =array();
        $res['comment_id']= $newcomment->id;
        $res['message']='تم إضافة التعليق بنجاح';
        
                $notification                = new notification();
                $notification->user_id       = $request->user_id;
                $notification->notification  = 'تم إضافة تعليقك بنجاح ';
                $notification->save();
        
        //send notifications 
        
        $comment_owner = member::where('id',$request->user_id)->first();
        $item = item::where('id',$request->item_id)->first();
        $users = member::where('suspensed',0)->where('firebase_token', '!=', null)->where('firebase_token', '!=', 0)->get();
        foreach($users as $user){
            
            //check if the user has comment in this item
            $comment = comment::where('user_id',$user->id)->where('item_id',$item->id)->first();
            if($comment && $item->user_id !== $user->id && $user->id !== $comment_owner->id ){
                
                $notification                = new notification();
                $notification->user_id       = $user->id;
                $notification->notification  = 'تم  التعليق على المنتج الذي قمت بالتعليق عليه من قبل  ' . $comment_owner->name;
                $notification->save();
        
        
                if ($user->firebase_token) {
                    $optionBuilder = new OptionsBuilder();
                    $optionBuilder->setTimeToLive(60 * 20);
    
                    $notificationBuilder = new PayloadNotificationBuilder(' تعليق جديد من  ' . $comment_owner->name);
                    $notificationBuilder->setBody($notification->notification)
                        ->setSound('default');
    
                    $dataBuilder = new PayloadDataBuilder();
                    $dataBuilder->addData(['a_type' => 'comment']);
                    $dataBuilder->addData(['content' => $newcomment->content]);
                    $option       = $optionBuilder->build();
                    $notification = $notificationBuilder->build();
                    $data         = $dataBuilder->build();
                    $token        = $user->firebase_token;
    
                    $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
    
                    $downstreamResponse->numberSuccess();
                    $downstreamResponse->numberFailure();
                    $downstreamResponse->numberModification();
                    $downstreamResponse->tokensToDelete();
                    $downstreamResponse->tokensToModify();
                    $downstreamResponse->tokensToRetry();
                }
            
                
                
            }elseif($item->user_id == $user->id && $user->id !== $comment_owner->id ){
                
                $notification                = new notification();
                $notification->user_id       = $user->id;
                $notification->notification  = 'تم  التعليق على منتجك من قبل  ' . $comment_owner->name;
                $notification->save();
        
        
            if ($user->firebase_token) {
                $optionBuilder = new OptionsBuilder();
                $optionBuilder->setTimeToLive(60 * 20);

                $notificationBuilder = new PayloadNotificationBuilder(' تعليق جديد من  ' . $comment_owner->name);
                $notificationBuilder->setBody($notification->notification)
                    ->setSound('default');

                $dataBuilder = new PayloadDataBuilder();
                $dataBuilder->addData(['a_type' => 'comment']);
                $dataBuilder->addData(['content' => $newcomment->content]);
                $option       = $optionBuilder->build();
                $notification = $notificationBuilder->build();
                $data         = $dataBuilder->build();
                $token        = $user->firebase_token;

                $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

                $downstreamResponse->numberSuccess();
                $downstreamResponse->numberFailure();
                $downstreamResponse->numberModification();
                $downstreamResponse->tokensToDelete();
                $downstreamResponse->tokensToModify();
                $downstreamResponse->tokensToRetry();
            }
        
            }
        }

        return $this->sendResponse('success',$res);
    }
    
    

    public function delcomment(Request $request)
    {
        $comment = comment::where('id', $request->comment_id)->first();
        if ($comment) {
            $comment->delete();
            return $this->sendResponse('success', 'تم حذف التعليق بنجاح');
        } else {
            return $this->sendError('success', 'هذا التعليق غير موجود');
        }
    }

    public function makefavoriteitem(Request $request)
    {
        $favorited = favorite_item::where('item_id', $request->item_id)->where('user_id', $request->user_id)->first();
        if ($favorited) {
            $errormessage = 'هذا المنتج موجود ف المفضلة';
            return $this->sendError('success', $errormessage);
        } else {
            $newfavad = new favorite_item;
            $newfavad->user_id = $request->user_id;
            $newfavad->item_id   = $request->item_id;
            $newfavad->save();
            $errormessage = 'تم اضافة المنتج ف المفضلة بنجاح';
            return $this->sendResponse('success', $errormessage);
        }
    }

    public function cancelfavoriteitem(Request $request)
    {
        favorite_item::where('user_id', $request->user_id)->where('item_id', $request->item_id)->delete();
        $errormessage = 'تم حذف المنتج من المفضلة';
        return $this->sendResponse('success', $errormessage);
    }

    public function categories(Request $request)
    {
        //main categories
        $categories = maincategory::all();
        if (count($categories) > 0) {
            return $this->sendResponse('success', $categories);
        } else {
            return $this->sendError('success', 'لا توجد أقسام');
        }
    }

    public function items(Request $request)
    {

        $lastitems = array();
        $items = item::where('suspensed', 0)->where('category_id', $request->category_id)->orderBy('id', 'desc')->get();
        if (count($items) > 0) {
            foreach ($items as $item) {
                $image     = item_image::where('item_id', $item->id)->first();
                $user = member::where('id', $item->user_id)->first();
                $country = country::where('id', $item->country_id)->first();
                $city = City::where('id', $item->city_id)->first();
                $humantime  = 'منذ'.Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans();
                 $arhumantime = str_replace(
                    array('0','1','2','3','4','5','6','7','8','9'),
                    array('٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'),
                    $humantime
                    );
                array_push(
                    $lastitems,
                    array(
                        "id"           => $item->id,
                        'image'        => $image,
                        'title'        => $item->artitle,
                        'created_at'     => $humantime,
                        'price'        => $item->price,
                        'country'      => $country->name,
                        'city'      => $city->name,
                        'username'         => $user->name,
                    )
                );
            }

            return $this->sendResponse('success', $lastitems);
        } else {
            return $this->sendError('success', 'لا يوجد منتجات في هذا القسم');
        }
    }


    public function filteritems(Request $request)
    {
        if ($request->city_id !== null && $request->category_id !== null && $request->ad_num == null) {
            $lastitems = array();
            $items = item::where('suspensed', 0)->where('category_id', $request->category_id)->where('city_id', $request->city_id)->orderBy('id', 'desc')->get();
            if (count($items) > 0) {
                foreach ($items as $item) {
                    $image     = item_image::where('item_id', $item->id)->first();
                    $user = member::where('id', $item->user_id)->first();
                    $country = country::where('id', $item->country_id)->first();
                    $city = City::where('id', $item->city_id)->first();
                    array_push(
                        $lastitems,
                        array(
                            "id"           => $item->id,
                            'image'        => $image,
                            'title'        => $item->artitle,
                            'created_at'     => $item->created_at,
                            'price'        => $item->price,
                            'country'      => $country->name,
                            'city'      => $city->name,
                            'owner'         => $user->name,
                        )
                    );
                }

                return $this->sendResponse('success', $lastitems);
            } else {
                return $this->sendError('success', 'لا يوجد منتجات في هذا القسم في هذه المدينة');
            }
        } elseif ($request->city_id !== null && $request->category_id == null && $request->ad_num == null) {
            $lastitems = array();
            $items = item::where('suspensed', 0)->where('city_id', $request->city_id)->orderBy('id', 'desc')->get();
            if (count($items) > 0) {
                foreach ($items as $item) {
                    $image     = item_image::where('item_id', $item->id)->first();
                    $user = member::where('id', $item->user_id)->first();
                    $country = country::where('id', $item->country_id)->first();
                    $city = City::where('id', $item->city_id)->first();
                    array_push(
                        $lastitems,
                        array(
                            "id"           => $item->id,
                            'image'        => $image,
                            'title'        => $item->artitle,
                            'created_at'     => $item->created_at,
                            'price'        => $item->price,
                            'country'      => $country->name,
                            'city'      => $city->name,
                            'owner'         => $user->name,
                        )
                    );
                }

                return $this->sendResponse('success', $lastitems);
            } else {
                return $this->sendError('success', 'لا يوجد منتجات في هذه المدينة ');
            }
        } elseif ($request->city_id == null && $request->category_id !== null && $request->ad_num == null) {
            $lastitems = array();
            $items = item::where('suspensed', 0)->where('category_id', $request->category_id)->orderBy('id', 'desc')->get();
            if (count($items) > 0) {
                foreach ($items as $item) {
                    $image     = item_image::where('item_id', $item->id)->first();
                    $user = member::where('id', $item->user_id)->first();
                    $country = country::where('id', $item->country_id)->first();
                    $city = City::where('id', $item->city_id)->first();
                    array_push(
                        $lastitems,
                        array(
                            "id"           => $item->id,
                            'image'        => $image,
                            'title'        => $item->artitle,
                            'created_at'     => $item->created_at,
                            'price'        => $item->price,
                            'country'      => $country->name,
                            'city'      => $city->name,
                            'owner'         => $user->name,
                        )
                    );
                }

                return $this->sendResponse('success', $lastitems);
            } else {
                return $this->sendError('success', 'لا يوجد منتجات في هذا القسم');
            }
        } elseif ($request->city_id == null && $request->category_id == null && $request->ad_num !== null) {
            $showitem = item::find($request->item_code);
            if ($showitem) {
                $iteminfo     = array();
                $commentinfo     = array();


                $images    = item_image::where('item_id', $showitem->id)->get();
                $user = member::where('id', $showitem->user_id)->first();
                $category = maincategory::where('id', $showitem->category_id)->first();
                $country = country::where('id', $showitem->country_id)->first();
                $city = City::where('id', $showitem->city_id)->first();


                $favorited = 0;
                if ($request->user_id) {
                    $fav = DB::table('favorite_items')->where('user_id', $request->user_id)->where('item_id', $showitem->id)->get();
                    $favorited = count($fav) != 0 ? 1 : 0;
                }

                $comments = comment::where('item_id', $request->item_id)->get();
                foreach ($comments as $comment) {
                    $com_user = member::where('id', $comment->user_id)->first();
                    array_push(
                        $commentinfo,
                        array(
                            "id"               => $comment->id,
                            "content"          => $comment->content,
                            "created_at"       => $comment->created_at,
                            "comment_owner"    => $com_user->name,
                            "count"            => count($comments),
                        )
                    );
                }


                array_push(
                    $iteminfo,
                    array(
                        "id"              => $showitem->id,
                        'title'           => $showitem->artitle,
                        "price"           => $showitem->price,
                        "code"            => (string)$showitem->id,
                        "category"        => $category->name,
                        "owner"           => $user->name,
                        "country"         => $country->name,
                        "city"         => $city->name,
                        "whatsapp"        => $showitem->whatsapp,
                        "phone"           => $showitem->phone,
                        "details"         => $showitem->details,
                        "video"           => $showitem->video,
                        'created_at'      => $showitem->created_at,
                        'favorited'       => $favorited,
                        'images'          => $images,
                        'commentinfo'     => $commentinfo,
                    )
                );

                return $this->sendResponse('success', $iteminfo);
            } else {
                $errormessage = 'المنتج غير موجود';
                return $this->sendError('success', $errormessage);
            }
        }
    }
    
    public function delitem(Request $request)
    {
        $delitem = item::where('id', $request->item_id)->first();
        if ($delitem) {
            item_image::where('item_id', $request->item_id)->delete();
            favorite_item::where('item_id', $request->item_id)->delete();
            comment::where('item_id', $request->item_id)->delete();
            report::where('ad_num', $delitem->id)->delete();
            $delitem->delete();
            return $this->sendResponse('success', 'تم حذف المنتج بنجاح');
        } else {
            return $this->sendError('success', 'هذا المنتج غير موجود');
        }
    }
    
    public function delimage(Request $request)
    {
        $image = item_image::where('id', $request->image_id)->first();
        if($image){
            $image->delete();
            return $this->sendResponse('success', 'تم حذف الصورة بنجاح');
        }else{
            return $this->sendError('success', 'هذه الصورة غير موجود');
        }
    }
}
