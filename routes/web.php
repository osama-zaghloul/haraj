<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clearcache', function() {

    $configCache = Artisan::call('config:cache');
    $clearCache = Artisan::call('cache:clear');
    
    return 'cleared';
});

// front routes
Auth::routes();
Route::get('/', function () {
  return redirect('/adminpanel');
});

//admin routes
Route::resource('adminpanel/', 'adminloginController');
Route::group(['middleware' => ['adminauth:admin']], function () {
  Route::resource('adminpanel/users', 'adminmemberController');
  Route::delete('myusersDeleteAll', 'adminmemberController@deleteAll');
  Route::resource('adminpanel/provider', 'providerController');
  Route::resource('adminpanel/treaty', 'admintreatyController');
  Route::resource('adminpanel/bannedads', 'adminbannedadsController');
  Route::resource('adminpanel/dissystem', 'admindissystemController');
  Route::resource('adminpanel/setapp', 'adminchangelogoController');
  Route::resource('adminpanel/items', 'adminitemController');
  Route::delete('myitemsDeleteAll', 'adminitemController@deleteAll');
  Route::resource('adminpanel/bills', 'adminillController');
  Route::delete('mybillsDeleteAll', 'adminillController@deleteAll');
  Route::resource('adminpanel/contactus', 'admincontactController');
  Route::delete('mycontactsDeleteAll', 'admincontactController@deleteAll');
  Route::resource('adminpanel/transfers', 'admintransferController');
  Route::delete('mytransferDeleteAll', 'admintransferController@deleteAll');
  Route::resource('adminpanel/reports', 'adminreportController');
  Route::resource('adminpanel/comreports', 'admincomreportController');
  Route::delete('myreportDeleteAll', 'adminreportController@deleteAll');
  Route::delete('mycomreportDeleteAll', 'admincomreportController@deleteAll');
  Route::get('adminpanel/showcomments/{id}', 'adminitemController@showcomments');
  Route::resource('adminpanel/sliders', 'adminsliderController');
  Route::delete('mysliderDeleteAll', 'adminsliderController@deleteAll');
  Route::resource('adminpanel/commissions', 'admincommissionController');
  Route::resource('adminpanel/blacklists', 'adminblacklistController');
  Route::delete('mycommissionDeleteAll', 'admincommissionController@deleteAll');
  Route::delete('myblacklistDeleteAll', 'adminblacklistController@deleteAll');
  Route::resource('adminpanel/maincategories', 'adminmaincategoryController');
  Route::resource('adminpanel/cities', 'adminCityController');
  Route::get('adminpanel/list_cities', 'adminCityController@list_cities')->name('admin.list_cities');
  Route::resource('adminpanel/countries', 'admincountryController');

  Route::delete('mycategoriesDeleteAll', 'admincategoryController@deleteAll');
});

//admin logout
Route::Delete('adminpanel/{id}', 'adminloginController@destroy');