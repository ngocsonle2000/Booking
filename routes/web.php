<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

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


//Home
Route::get('/', 'HomeController@index')->name('home.index');

//room
Route::get('/home', 'HomeController@search')->name('home.search');
Route::get('/city/{slug}' ,'HomeController@City')->name('home.City');
Route::get('/accommodation/{slug}' ,'HomeController@accommodation')->name('home.accommodation');
Route::get('/hotel/{slug}/{id}/{city}', 'HomeController@hotel_room')->name('home.hotel_room');
Route::get('/hotel/{id}/{slug}', 'HomeController@room_details')->name('home.room_details');
Route::get('/don-dat-cho' ,'HomeController@order')->name('home.order');
Route::get('/don-dat-cho/{codeOrder}' ,'HomeController@EditOrder')->name('home.EditOrder');
Route::post('/don-dat-cho/{codeOrder}' ,'HomeController@UpdateOrder')->name('home.UpdateOrder');
Route::post('/comment/{CodeOrders}/{idHotel}/{idAdmin}', 'CommentController@store')->name('comment.post');
Route::PUT('/comment', 'CommentController@update')->name('comment.update');
//post
Route::get('/post' ,'HomeController@post')->name('home.post');
Route::get('/post/{slug}' ,'HomeController@post_details')->name('home.post_details');
//send mail
Route::post('/sendmail', 'HomeController@sendMail')->name('home.sendMail');

// Login
Route::get('/Login.html', 'LoginController@login')->name('login');
Route::post('/Login.html', 'LoginController@post_login')->name('login');
Route::post('/Login-register.html', 'LoginController@store')->name('login.store');
Route::get('/Logout', 'LoginController@logout')->name('logout');

//Admin


Route::group(['prefix' => 'user'], function(){
    Route::get('/', 'AdminController@dasboard')->name('user.dasboard');
    Route::get('/Comment', 'CommentController@index')->name('Comment.index');
    Route::POST('/Comment/{CodeOrders}/{parent_id}', 'CommentController@parent')->name('Comment.parent');
    Route::PUT('/Comment/{id}', 'CommentController@parent_update')->name('Comment.parent_update');
    Route::resources([
        'Dasboard' => 'DasboardController',
        'KindRoom' => 'KindRoomController',
        'Hotel'    => 'HotelControler',
        'Booking'  => 'BookingController',
        'Post'     => 'PostController',
        'Promo'    => 'PromoCodeController',
        'Comment'  => 'CommentController',
        'Comfort'  => 'TienNghiController',
    ]);
    Route::get('/{id}', 'DasboardController@hotel')->name('room.hotel');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){

    Route::get('Dasboard', 'AdminDasboardController@index')->name('Dasboard.index');

    Route::get('Account', 'AccountController@index')->name('Account.index');
    // Route::get('Account/create', 'AccountController@create')->name('Account.create');
    // Route::post('Account/create/store', 'AccountController@store')->name('Account.store');
    // Route::get('Account/edit/{id}', 'AccountController@edit')->name('Account.edit');

    // Route::get('Account/Permission/create', 'AccountController@PermissionCreate')->name('Permission.create');
    // Route::post('Account/Permission/store', 'AccountController@PermissionStore')->name('Permission.store');
    // Route::get('Account/lock/{id}/{status}', 'AccountController@lock')->name('Account.lock');
    // Route::get('error', 'AccountController@error')->name('error');
    // Route::get('post-blog', 'PostBlogController@index')->name('admin.blog')
    // Route::get('banner', 'BannerController@index')->name('')

    Route::resources([
        'blog'          => 'PostBlogController',
        'banner'        => 'BannerController',
        'city'          => 'CityController',
        'accommodation' => 'AccommodationsController',
    ]);
});

Route::group(['prefix' => 'API'], function(){
    Route::post('/dauthang', 'ApiController@dauthang')->name('dauthang');
    Route::post('/day-order', 'ApiController@dayOrder')->name('day-order');
    Route::post('/date-filter', 'ApiController@dateFilter')->name('date-filter');
    Route::post('/HotelBrand', 'ApiController@HotelBrand')->name('HotelBrand');
    Route::post('/ApplyPromo', 'ApiController@ApplyPromo')->name('ApplyPromo');
    Route::post('/branchHotel_Confort', 'ApiController@branchHotel_Confort')->name('branchHotel_Confort');
});
