<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContractMail;
use Mail;
use App\Models\Driver;
use App\Models\Owner;

class MailContractController extends Controller
{
    public function send(Request $request) {

        $request->validate([
            'dateDeparture' => 'required',
            'timeDeparture' => 'required',
            'dateRevert' => 'required|after:dateDeparture',
            'timeRevert' => 'required',
            'carNumber' => 'required|string',
            'subTotal' => 'required|numeric|min:1',
            'confirm' => 'required',
            ]);

        $to = [
            [
                'email' => 'tatsuyawada1995@gmail.com',
            ],
        ];
        
        $idDriver = $request->idDriver;
        $driverInfo = Driver::where('id',$idDriver)->first();
        $idOwner = Auth::id();
        $ownerInfo = Owner::where('id',$idOwner)->first();
        //dd($driverInfo);
        Mail::to($to)->send(new ContractMail($request,$driverInfo,$ownerInfo));
        //return view('owner/contract');
    }
}
