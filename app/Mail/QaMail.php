<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QaMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function build()
    {
        //dd($this->request);
        return $this->view('emails.qa')
                    ->from($this->request->email)
                    ->bcc($this->request->email)
                    ->subject($this->request->title)
                    ->with(['request'=> $this->request]);
    }
}
