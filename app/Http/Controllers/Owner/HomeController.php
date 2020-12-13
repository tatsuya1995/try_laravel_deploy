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

    public function postIn(Request $request)
    {   
        //投稿内容の保存
        $post = new Post;
        $post->idOwner = Auth::id();
        $post->idDriver = $request->input('idDriver'); 
        $post->comment = $request->input('comment');
        $post->save();
        //dd($post);
        //talkDetailsにドライバー情報を渡す
        $idDriver = $request->idDriver;
        return redirect()->action('Owner\HomeController@talkDetails',['idDriver'=>$idDriver]);
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
        $posts = $query->get();
        return view('owner/talk',compact('ownerInfo','driverInfo','posts'));
        
        //dd($posts);
    }
    
    public function contract(){
        return view('owner/contract');
    }

    
}
