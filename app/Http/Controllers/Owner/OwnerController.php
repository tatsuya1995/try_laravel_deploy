<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Owner;
use App\Models\Driver;
use App\Models\OwnerSchedule;
use App\Models\Chat;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Storage;
use App\Events\Pusher;


class OwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owner');
    }

    //オーナー情報のプロパティ宣言
    var $idOwner ,$owner;

    //オーナー情報のメソッド宣言
    public function ownerInfo() {
        $idOwner = Auth::id();
        $ownerInfo = Owner::find($idOwner);
        return $ownerInfo;
    }

    public function show() 
    {   
        $owner = $this->ownerInfo();
        return view('owner.show',compact('owner'));
    }

    public function edit($id)
    {
        $owner = $this->ownerInfo();
        return view('owner.edit',compact('owner'));
    }

    public function update(Request $request, $id)
    {   
        $owner = Owner::find($id);
        $owner->nameOwner = $request->input('nameOwner');
        $owner->email = $request->input('email');
        $owner->nameCar = $request->input('nameCar');
        $owner->numPeople = $request->input('numPeople'); 

        //S3への画像保存
        $iconOwner = $request->iconOwner;
        $pathIconOwner = Storage::disk('s3')->putFile('/iconOwner',$iconOwner,'public');
        $imgCar = $request->imgCar;
        $pathImgCar = Storage::disk('s3')->putFile('/imgCar',$imgCar,'public');
        $owner->iconOwner = Storage::disk('s3')->url($pathIconOwner);
        $owner->imgCar =Storage::disk('s3')->url($pathImgCar);

        $owner->save();
        return redirect('owner/show');
    }

    public function scheduleIn()
    {
        $ownerSchedules = OwnerSchedule::where('idOwner', Auth::id())
                                        ->get();
        return view('owner.schedule',['ownerSchedules' => $ownerSchedules]);
    }

    public function scheduleOut(Request $request)
    {  
        $request->validate([
        'departure' => 'required',
        'revert' => 'required|after:departure',
        'place' => 'required',
        ]);

        $ownerSchedule = new OwnerSchedule;
        $ownerSchedule->departure = $request->input('departure');
        $ownerSchedule->revert = $request->input('revert');
        $ownerSchedule->place = $request->input('place');
        $ownerSchedule->idOwner = Auth::id();
        //dd($ownerSchedule);
        $ownerSchedule->save();
        return redirect('owner/schedule');
    }

    public function destroy($id)
    {
        $ownerSchedule = OwnerSchedule::find($id);
        $ownerSchedule->delete();
        return redirect('owner/schedule');
    }


    public function talkerSelect()
    {   
        //オーナー情報の取得
        $idOwner = Auth::id();
        $posts = Chat::join('drivers','chats.idDriver','=','drivers.id')
                        ->where('idOwner','=',$idOwner)
                        ->groupBy('idDriver')
                        ->orderBy('chats.created_at','desc')
                        ->get();
        //dd($posts);
        return view('owner/talker_select',compact('posts'));
    }


    public function talkIn(Request $request, $idDriver)
    {   
        //オーナー情報の表示
        $idOwner = Auth::id();
        $ownerInfo = Owner::where('id', $idOwner)->first();
        
        //ドライバー情報の表示
        $idDriver = (int)$request->idDriver;
        $driverInfo = Driver::where('id', $idDriver)->first();

        $posts = Chat::where('idOwner', $idOwner)
                        ->where('idDriver', $idDriver)
                        ->get();
        //dd($posts);
        return view('owner/talk',compact('ownerInfo','driverInfo','posts'));
    }
    public function postIn(Request $request)
    {   
        $insertParam = [
            'idOwner' => (int)$request->input('idOwner'),
            'idDriver' => (int)$request->input('idDriver'),
            'comment' => $request->input('comment'),
        ];
        //チャットデータ保存
        try{
            Chat::insert($insertParam);
        }catch (\Exception $e){
            return false;
        }
        //イベント発火
        event(new Pusher($request->all()));
        return true;
    }

    public function talk(Request $request, $idDriver)
    {   
        // オーナーとドライバーのidと氏名を取得
        $idOwner = Auth::id();
        $ownerInfo = Owner::where('id', $idOwner)->first();
        $driverInfo = Driver::where('id', $idDriver)->first();

        $query = Chat::where('idOwner' , $idOwner)->where('idDriver', $idDriver);
        $posts = $query->orderBy('created_at','desc')->get();
        return view('owner/talk',compact('ownerInfo','driverInfo','posts'));
        
    }
    
    public function contract($idDriver)
    {
        $idOwner = Auth::id();
        $ownerInfo = Owner::where('id', $idOwner)->first();
        $driverInfo = Driver::where('id', $idDriver)->first();
        //dd($driverInfo);

        return view('owner/contract',compact('ownerInfo','driverInfo'));
    }
    
}
