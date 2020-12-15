<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContractMail;
use Mail;

class MailContractController extends Controller
{
    public function send() {

        $to = [
            [
                'email' => 'tatsuyawada1995@gmail.com',
            ],
        ];
        
        Mail::to($to)->send(new ContractMail());
        return view('owner/contract');
    }
}
