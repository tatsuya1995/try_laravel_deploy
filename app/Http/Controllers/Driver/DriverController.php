<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Events\Pusher;
use App\Models\Driver;
use App\Models\Owner;
use App\Models\Post;
use App\Models\Chat;
use App\Models\OwnerSchedule;
use Illuminate\Support\Facades\Auth;
use Storage;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:driver');
    }

    //ドライバー情報のプロパティ宣言
    var $id ,$driver;
    //ドライバー情報のメソッド宣言
    public function driverId() {
        $id = Auth::id();
        return $id;
    }
    public function driverInfo() {
        $id = Auth::id();
        $driver = Driver::find($id);
        return $driver;
    }

//ーーーーーー登録情報表示・編集ーーーーーーーーーーーーーーーー

    public function show()
    {    
        return view('driver.show',['driver'=>$this->driverInfo()]);
    }

    public function edit()
    {
        return view('driver.edit',['driver'=>$this->driverInfo()]);
    }

    public function update(Request $request)
    {   
        $driver = Driver::find($this->driverId());
        $driver->nameDriver = $request->input('nameDriver');
        $driver->email = $request->input('email');

        //アイコン画像をS3ストレージへ保存
        $iconDriver = $request->iconDriver;
        $pathIconDriver = Storage::disk('s3')->putFile('/iconDriver',$iconDriver,'public');
        $driver->iconDriver = Storage::disk('s3')->url($pathIconDriver);
        
        $driver->save();
        return redirect('driver/show');
    }

 //ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー


//ーーーーーー貸出日程検索ーーーーーーーーーーーーーーーー

    public function searchIn()
    {
        return view('driver/search');
    }

    public function searchOut(Request $request)
    {   
        $request->validate([
            'departure' => 'required',
            'revert' => 'required|after:departure',
            'place' => 'required',
            'numPeople' => 'min:1',
        ]);

        //検索機能
        $searches = OwnerSchedule::join('owners','_owner_schedules.idOwner','=','owners.id')
                                    ->where([
                                        ['departure','<=',$request->departure],
                                        ['revert','>=',$request->revert],
                                        ['place','=',$request->place],
                                        ['numPeople','>=',$request->numPeople],
                                    ])->get();
        return view('driver/search',compact('searches','request'));
    }

 //ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー


 //ーーーーーートークーーーーーーーーーーーーーーーー

    public function talkIn(Request $request)
    {   
        //オーナー情報の表示
        $idOwner = $request->idOwner;
        $ownerInfo = Owner::where('id', $idOwner)->first();
        
        //ドライバー情報の表示
        $idDriver = Auth::id();
        $driverInfo = Driver::where('id', $idDriver)->first();

        $param = [
            'idOwner' => $idOwner,
            'idDriver' => $idDriver,
        ];
        //投稿の取得
        $posts= Chat::where('idOwner' , $idOwner)
                    ->where('idDriver', $idDriver)
                    ->get();
        return view('driver/talk',compact('ownerInfo','driverInfo','posts'));
    }

    public function postIn(Request $request)
    {   
        $insertParam = [
            'idOwner' => (int)$request->input('idOwner'),
            'idDriver' => (int)$request->input('idDriver'),
            'comment' => $request->input('comment'),
            'sort' => 1,
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
    public function deletePost(Request $request)
    {   
        $idOwner = $request->idOwner;
        $idPost = $request->id;
        $post = Post::find($idPost);
        $post->delete();
        return redirect()->action('Driver\DriverController@talkIn',['idOwner' => $idOwner]);
    }
 //ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー


}
