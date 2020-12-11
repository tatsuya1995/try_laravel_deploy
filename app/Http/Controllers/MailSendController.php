<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendMail;
use Mail;
use App\Models\Driver;

class MailSendController extends Controller
{
    public function send(Request $request){

        $data = [];

        // Mail::send('emails.test',$data,function($message){
        //     $message->to('tatsuyawada1995@gmail.com','test')
        //             ->subject('【お問い合わせフォーム】');
        // });
        

        $to = [
            [
                'email' => 'tatsuyawada1995@gmail.com',
            ],
        ];
        Mail::to($to)->send(new SendMail($request));
        return view('/qa');
    }
}
