<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContractMail;
use Mail;
use App\Models\Driver;
use App\Models\Owner;
use App\Models\Contract;


class MailContractController extends Controller
{
    public function send(Request $request) {

        $request->validate([
            'dateDeparture' => 'required',
            'timeDeparture' => 'required',
            'dateRevert' => 'required|after_or_equal:dateDeparture',
            'timeRevert' => 'required',
            'carNumber' => 'required|string',
            'subTotal' => 'required|numeric|min:1',
            'confirm' => 'required',
            ]);
            
        Contract::create([
            'nameDriver' => $request->nameDriver,
            'nameOwner' => $request->nameOwner,
            'dateDeparture' => $request->dateDeparture,
            'timeDeparture' => $request->timeDeparture,
            'dateRevert' => $request->dateRevert,
            'timeRevert' => $request->timeRevert,
            'nameCar' => $request->nameCar,
            'numPeople' => $request->numPeople,
            'carNumber' => $request->carNumber,
            'subTotal' => $request->subTotal,
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
        return view('owner/contract',compact('driverInfo','ownerInfo'));
    }
}
