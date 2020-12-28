<?php
use App\Events\Pusher;

//ログイン前　ドライバー・オーナー共通部分
Route::get('/','CommonController@index')->name('index');
Route::get('/select','CommonController@select');
Route::get('/qa','CommonController@qa');
//管理者用　契約状況確認ページ
Route::get('/finalContract','CommonController@finalContract');
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

        //検索
        Route::get('search','DriverController@searchIn')->name('search');
        Route::post('search','DriverController@searchOut')->name('search');
        
        //トーク
        Route::post('talk','DriverController@talkIn')->name('talk');
        Route::get('talk/{idOwner}','DriverController@talkIn');
        Route::post('post','DriverController@postIn')->name('post');
        Route::post('delete','DriverController@deletePost')->name('deletePost');

        //登録情報表示
        Route::get('show','DriverController@show')->name('show');
        Route::get('edit/{id}','DriverController@edit')->name('edit');
        Route::post('update/{id}','DriverController@update')->name('update');
    
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

        Route::get('show','OwnerController@show')->name('show');
        Route::get('schedule','OwnerController@scheduleIn')->name('schedule');
        Route::post('schedule','OwnerController@scheduleOut')->name('owner.schedule');
        Route::post('destroy/{id}','OwnerController@destroy')->name('destroy');
        
        Route::post('talkerSelect','OwnerController@talkerSelect')->name('talkerSelect');
        Route::get('talkerSelect','OwnerController@talkerSelect')->name('talkerSelect');
        Route::get('talk/{idDriver}','OwnerController@talkIn')->name('talk');
        Route::post('talk/{idDriver}','OwnerController@talkIn')->name('talkpost');
        Route::post('post','OwnerController@postIn')->name('post');

        Route::get('contract/{idDriver}','OwnerController@contract')->name('contract');
        Route::get('/mailContract','MailContractController@send')->name('mailContract');

        //登録情報表示
        Route::get('show','OwnerController@show')->name('show');
        Route::get('edit/{id}','OwnerController@edit')->name('edit');
        Route::post('update/{id}','OwnerController@update')->name('update');


    });
});

Auth::routes();



