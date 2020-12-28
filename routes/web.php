<?php
use App\Events\Pusher;

//ーーーーログイン前　共通部分ーーーーー
Route::get('/','CommonController@index')->name('index');
Route::get('/select','CommonController@select');
Route::get('/qa','CommonController@qa');
//管理者用　契約状況確認ページ
Route::get('/finalContract','CommonController@finalContract');
//Q＆Aメールの送信
Route::post('/mail','MailQaController@send');
//ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

Route::get('/pusher','TalkController@pusherGet')->name('pusher.get');
Route::post('/pusher/create','TalkController@pusherCreate')->name('pusher.create');


//ーーーー　ドライバー　ーーーーーーーーーーーーーーーーーーー
Route::namespace('Driver')->prefix('driver')->name('driver.')->group(function(){

    Auth::routes([
        'register' => true,
        'reset' => false,
        'verify' => false
    ]);

    //ログイン認証後
    Route::middleware('auth:driver')->group(function(){

        //登録情報表示
        Route::get('show','DriverController@show')->name('show');
        Route::get('edit','DriverController@edit')->name('edit');
        Route::post('update','DriverController@update')->name('update');

        //貸出日程検索
        Route::get('search','DriverController@searchIn')->name('search');
        Route::post('search','DriverController@searchOut')->name('search');

        //トーク
        Route::post('talk','DriverController@talkIn')->name('talk');
        Route::get('talk/{idOwner}','DriverController@talkIn');
        Route::post('post','DriverController@postIn')->name('post');
        Route::post('delete','DriverController@deletePost')->name('deletePost');

    });
});
//ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー



//ーーーー　オーナー　ーーーーーーーーーーーーーーーーーーーーーーーー
Route::namespace('Owner')->prefix('owner')->name('owner.')->group(function(){

    Auth::routes([
        'register' => true,
        'reset' => false,
        'verify' => false
    ]);

    //ログイン認証後
    Route::middleware('auth:owner')->group(function(){

        //登録情報表示
        Route::get('show','OwnerController@show')->name('show');
        Route::get('edit/{id}','OwnerController@edit')->name('edit');
        Route::post('update/{id}','OwnerController@update')->name('update');
        
        //貸出日程登録
        Route::get('schedule','OwnerController@scheduleIn')->name('schedule');
        Route::post('schedule','OwnerController@scheduleOut')->name('owner.schedule');
        Route::post('destroy/{id}','OwnerController@destroy')->name('destroy');

        //トークの相手を選択
        Route::post('talkerSelect','OwnerController@talkerSelect')->name('talkerSelect');
        Route::get('talkerSelect','OwnerController@talkerSelect')->name('talkerSelect');

        //トーク
        Route::get('talk/{idDriver}','OwnerController@talkIn')->name('talk');
        Route::post('talk/{idDriver}','OwnerController@talkIn')->name('talkpost');
        Route::post('post','OwnerController@postIn')->name('post');

        //最終契約と確認メールの送信
        Route::get('contract/{idDriver}','OwnerController@contract')->name('contract');
        Route::get('/mailContract','MailContractController@send')->name('mailContract');

    });
});
//ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー



