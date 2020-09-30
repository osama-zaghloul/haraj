<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//user Controller routes
Route::post('register', 'API\userController@register');
Route::post('login', 'API\userController@login');
Route::post('profile', 'API\userController@profile');
Route::post('rechangepass', 'API\userController@rechangepass');
Route::post('updateprofile', 'API\userController@update');
Route::post('forgetpassword', 'API\userController@forgetpassword');
Route::post('activcode', 'API\userController@activcode');
Route::post('mynotification', 'API\userController@mynotification');
Route::post('myfavoriteitems', 'API\userController@myfavoriteitems');
Route::post('updatefirebasebyid', 'API\userController@updatefirebasebyid');
Route::post('deletenotification', 'API\userController@deletenotification');
Route::post('changepassword', 'API\userController@changepassword');
Route::post('addlike', 'API\userController@addlike');
Route::post('showuser', 'API\userController@showuser');
Route::post('bills', 'API\userController@bills');
Route::post('showbill', 'API\userController@showbill');
Route::post('blacklist', 'API\userController@blacklist');


//App Setting Controller 
Route::post('settinginfo', 'API\appsettingController@settingindex');
Route::post('contactus', 'API\appsettingController@contactus');
Route::post('home', 'API\appsettingController@home');
Route::post('addtransfer', 'API\appsettingController@addtransfer');
Route::post('makereport', 'API\appsettingController@makereport');
Route::post('makereport_comment', 'API\appsettingController@makereport_comment');
Route::post('commissions', 'API\appsettingController@commissions');
Route::post('countries', 'API\appsettingController@countries');



//Item Controller 
Route::post('showitem', 'API\itemController@showitem');
Route::post('makeitem', 'API\itemController@makeitem');
Route::post('makefavoriteitem', 'API\itemController@makefavoriteitem');
Route::post('cancelfavoriteitem', 'API\itemController@cancelfavoriteitem');
Route::post('items', 'API\itemController@items');
Route::post('categories', 'API\itemController@categories');
Route::post('filteritems', 'API\itemController@filteritems');
Route::post('makecomment', 'API\itemController@makecomment');
Route::post('delcomment', 'API\itemController@delcomment');
Route::post('delitem', 'API\itemController@delitem');
Route::post('upitem', 'API\itemController@upitem');
Route::post('delimage', 'API\itemController@delimage');




//chat Controller 
Route::post('makechat', 'API\chatController@makechat');
Route::post('getchat', 'API\chatController@getchat');
Route::post('getchaters', 'API\chatController@getchaters');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});