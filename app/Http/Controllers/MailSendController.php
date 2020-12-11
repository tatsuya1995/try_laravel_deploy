<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendMail;
use Mail;
use App\Models\Driver;

class MailSendController extends Controller
{
    public function send(){

        $data = [];

        // Mail::send('emails.test',$data,function($message){
        //     $message->to('tatsuyawada1995@gmail.com','test')
        //             ->subject('【お問い合わせフォーム】');
        // });
        
        $driver = driver::find(1);
        $email = $driver->email;
        //dd($email);

        $to = [
            [
                'email' => 'tatsuyawada1995@gmail.com',
                'name' => 'Test',
            ],
            [
                'email' => $email,
            ],
        ];
        Mail::to($to)->send(new SendMail());
    }
}
