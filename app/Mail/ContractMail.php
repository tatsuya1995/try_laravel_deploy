<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContractMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request,$driverInfo,$ownerInfo)
    {
        $this->request = $request;
        $this->driverInfo = $driverInfo;
        $this->ownerInfo = $ownerInfo;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        //dd($this->driverInfo);
        //dd($this->request);

        return $this->view('emails.contract')
                    ->from('tatsuyawada1995@gmail.com')
                    ->subject('契約内容確認')
                    ->with(['request'=> $this->request,
                            'driverInfo'=> $this->driverInfo,
                            'ownerInfo' => $this->ownerInfo,
                            ]);
    }
}
