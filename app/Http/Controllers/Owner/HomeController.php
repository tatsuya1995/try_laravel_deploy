<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Owner;
use App\Models\OwnerSchedule;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Storage;
use App\Events\Pusher;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owner');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $id = Auth::id();
        $owner = Owner::find($id);
        //dd($owner);
        return view('owner.show',compact('owner'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show() 
    {   
        $idOwner = Auth::id();
        $owner = Owner::find($idOwner);
        //dd($owner);
        return view('owner.show',compact('owner'));
    }

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function edit($id)
    {
        $idOwner = $id;
        $owner = Owner::find($idOwner);
        return view('owner.edit',compact('owner'));
    }

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function update(Request $request, $id)
    {   
        $owner = Owner::find($id);
        $owner->nameOwner = $request->input('nameOwner');
        $owner->email = $request->input('email');

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
        $ownerSchedules = DB::table('_owner_schedules')
        ->where('idOwner', '=', Auth::id())
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

        $ownerSchedule->save();
        return redirect('owner/schedule');
    }

    public function destroy($id)
    {
        $ownerSchedule = OwnerSchedule::find($id);
        $ownerSchedule->delete();
        return redirect('owner.schedule');
    }

    public function talkerSelect()
    {   
        //オーナー情報の取得
        $idOwner = Auth::id();
        $posts = DB::table('posts')
                    ->join('drivers','posts.idDriver','=','drivers.id')
                    ->where('idOwner','=',$idOwner)
                    ->groupBy('idDriver')
                    ->orderBy('posts.created_at','desc')
                    ->get();
        //dd($posts);
        return view('owner/talkerSelect',compact('posts'));
    }

    public function talkIn(Request $request, $idDriver)
    {   
        
        //オーナー情報の表示
        $idOwner = Auth::id();
        $ownerInfo = DB::table('owners')->where('id','=',$idOwner)->first();
        
        //ドライバー情報の表示
        $idDriver = (int)$request->idDriver;
        $driverInfo = DB::table('drivers')->where('id','=',$idDriver)->first();
        //投稿内容の表示
        // $posts = DB::table('posts')->where([
        //     ['idOwner','=',$idOwner],
        //     ['idDriver','=',$idDriver],
        // ])->orderBy('created_at','desc')
        // ->paginate(10);

        //dd($param);
        $query = Chat::where('idOwner' , $idOwner)->where('idDriver', $idDriver);
        // $query->orWhere(function($query) use($idOwner,$idDriver){
        //     $query->where('idOwner',$idOwner);
        //     $query->where('idDriver',$idDriver);
        // });
        $posts = $query->get();
        //dd($posts);
        return view('owner/talk',compact('ownerInfo','driverInfo','posts'));
    }
    public function postIn(Request $request)
    { 
        $insertParam = [
            'idOwner' => (int)$request->input('idOwner'),
            'idDriver' => (int)$request->input('idDriver'),
            'comment' => $request->input('comment'),
            'sort' => 0,
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
        $ownerInfo = DB::table('owners')->where('id','=',$idOwner)->first();
        $driverInfo = DB::table('drivers')->where('id','=',$idDriver)->first();
        //ドライバー、オーナー区別するトライ
        $param = [
            'idOwner' => $idOwner,
            'idDriver' => $idDriver,
        ];
        $query = Chat::where('idOwner' , $idOwner)->where('idDriver', $idDriver);
        $query->orWhere(function($query) use($idOwner,$idDriver){
            $query->where('idOwner',$idOwner);
            $query->where('idDriver',$idDriver);
        });
        $posts = $query->orderBy('created_at','desc')->get();
        return view('owner/talk',compact('ownerInfo','driverInfo','posts'));
        
        //dd($posts);
    }
    
    public function contract(){
        return view('owner/contract');
    }

    
}
