<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\QaMail;
use Mail;
use App\Models\Driver;

class MailQaController extends Controller
{
    public function send(Request $request){

        $to = [
            [
                'email' => 'tatsuyawada1995@gmail.com',
            ],
        ];
        Mail::to($to)->send(new QaMail($request));
        return view('/qa');
    }
}
