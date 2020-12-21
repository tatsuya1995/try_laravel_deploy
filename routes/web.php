<?php
use App\Events\Pusher;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//画像アップロード部分
Route::get('/images','ImagesController@index');
Route::get('/images/new','ImagesController@store');
Route::post('/images','ImagesController@create');
Route::get('/images/{filename}','ImagesController@show');
Route::post('/images/{filename}','ImagesController@destroy');

//ログイン前共通部分
Route::get('/','commonController@index')->name('index');
Route::get('/qa','commonController@qa');
Route::get('/select','commonController@select');
//メールの送信
Route::post('/mail','MailQaController@send');


//ドライバー
Route::namespace('Driver')->prefix('driver')->name('driver.')->group(function(){

    Auth::routes([
        'register' => true,
        'reset' => false,
        'verify' => false
    ]);

    //ログイン認証後
    Route::middleware('auth:driver')->group(function(){

        //ブレイド の名前書いたり　見てわかる物は書かない
        //Route::get('home','HomeController@searchIn');
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
    
        //pusherテスト
        Route::get('/pusher','TalkController@pusherGet')->name('pusher.get');
        Route::post('/pusher/create','TalkController@pusherCreate')->name('pusher.create');

    });
});

//オーナー
Route::namespace('Owner')->prefix('owner')->name('owner.')->group(function(){

    Auth::routes([
        'register' => true,
        'reset' => false,
        'verify' => false
    ]);


    //ログイン認証後
    Route::middleware('auth:owner')->group(function(){

        //Route::resource('home','HomeController',['only' => 'index']);
        Route::get('show','HomeController@show')->name('show');
        Route::get('schedule','HomeController@scheduleIn')->name('schedule');
        Route::post('schedule','HomeController@scheduleOut')->name('owner.schedule');
        Route::post('destroy/{id}','HomeController@destroy')->name('destroy');
        
        Route::post('talkerSelect','HomeController@talkerSelect')->name('talkerSelect');
        Route::get('talkerSelect','HomeController@talkerSelect')->name('talkerSelect');
        Route::get('talk/{idDriver}','HomeController@talkIn')->name('talk');
        Route::post('talk/{idDriver}','HomeController@talkIn')->name('talkpost');
        Route::post('post','HomeController@postIn')->name('post');

        Route::get('contract/{idDriver}','HomeController@contract')->name('contract');
        Route::get('/mailContract','MailContractController@send')->name('mailContract');

        //登録情報表示
        Route::get('show','HomeController@show')->name('show');
        Route::get('edit/{id}','HomeController@edit')->name('edit');
        Route::post('update/{id}','HomeController@update')->name('update');


    });
});

Auth::routes();



