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

Route::get('/', function () {
    return view('welcome');
});

//画像アップロード部分
Route::get('/images','ImagesController@index');
Route::get('/images/new','ImagesController@store');
Route::post('/images','ImagesController@create');
Route::get('/images/{filename}','ImagesController@show');
Route::post('/images/{filename}','ImagesController@destroy');

//ログイン前共通部分
Route::get('/index','commonController@index')->name('index');
Route::get('/qa','commonController@qa');
Route::get('/select','commonController@select');


//ドライバー
Route::namespace('Driver')->prefix('driver')->name('driver.')->group(function(){

    //ログイン認証
    Auth::routes([
        'register' => true,
        'reset' => false,
        'verify' => false
    ]);

    //ログイン認証後
    Route::middleware('auth:driver')->group(function(){


        Route::get('home','HomeController@searchIn');
        Route::get('search','HomeController@searchIn')->name('search');
        Route::post('search','HomeController@searchOut')->name('search');
        Route::post('talk','HomeController@talkIn')->name('talk');
        Route::get('talk/{idOwner}','HomeController@talkIn');
        Route::post('post','HomeController@postIn')->name('post');
        Route::post('delete','HomeController@deletePost')->name('deletePost');

        //登録情報表示
        Route::get('show','HomeController@show')->name('show');
        Route::get('edit/{id}','HomeController@edit')->name('edit');
        Route::post('update/{id}','HomeController@update')->name('update');
    
    });
});
//オーナー
Route::namespace('Owner')->prefix('owner')->name('owner.')->group(function(){

    //ログイン認証
    Auth::routes([
        'register' => true,
        'reset' => false,
        'verify' => false
    ]);


    //ログイン認証後
    Route::middleware('auth:owner')->group(function(){

        Route::resource('home','HomeController',['only' => 'index']);
        Route::get('show','HomeController@show')->name('show');
        Route::get('schedule','HomeController@scheduleIn')->name('schedule');
        Route::post('schedule','HomeController@scheduleOut')->name('owner.schedule');
        Route::post('destroy/{id}','HomeController@destroy')->name('destroy');
        Route::get('talk','HomeController@talk')->name('talk');
        Route::post('talkDetails/{idDriver}','HomeController@talkDetails')->name('talkDetails');
        Route::get('talkDetails/{idDriver}','HomeController@talkDetails')->name('talkDetails');

        Route::post('post/{idDriver}','HomeController@postIn')->name('post');

        //登録情報表示
        Route::get('show','HomeController@show')->name('show');
        Route::get('edit/{id}','HomeController@edit')->name('edit');
        Route::post('update/{id}','HomeController@update')->name('update');


    });
});

Auth::routes();



