<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Owner;
use App\Models\OwnerSchedule;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {   

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }

    public function scheduleIn()
    {
        $ownerSchedules = DB::table('_owner_schedules')
        ->where('idOwner', '=', Auth::id())
        ->get();
        return view('owner.schedule',['ownerSchedules' => $ownerSchedules]);
    }
    public function scheduleOut(Request $request)
    {   
        //バリデーション
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

    public function talk()
    {   
        //オーナー情報の取得
        $idOwner = Auth::id();
        $ownerInfo = DB::table('owners')->where('id','=',$idOwner)->first();
        
        $posts = DB::table('posts')
                    ->join('drivers','posts.idDriver','=','drivers.id')
                    ->where('idOwner','=',$idOwner)
                    ->orderBy('posts.created_at','desc')
                    //->groupBy('idDriver')  考えるやつ
                    //->limit(2)
                    ->get();
        //dd($posts);
        return view('owner.talk',compact('ownerInfo','posts'));
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
        //return redirect('driver.talk',['idOwner' => $idOwner]);
        return redirect()->action('Owner\HomeController@talkDetails',['idDriver'=>$idDriver]);
    }

    public function talkDetails(Request $request)
    {   
        // オーナーとドライバーのidと氏名を取得
        $idOwner = Auth::id();
        $idDriver = $request->idDriver;
        
        // $nameOwner = DB::table('owners')
        //             ->where('id','=',$idOwner)
        //             ->select('nameOwner')
        //             ->first();
        // $nameDriver = DB::table('drivers')
        //             ->where('id','=',$idDriver)
        //             ->select('nameDriver')
        //             ->first();
        //dd($nameDriver);

        //投稿内容の表示
        $posts = DB::table('posts')
        ->join('Owners','posts.idOwner','=','Owners.id')
        ->join('Drivers','posts.idDriver','=','Drivers.id')
        ->where([            
            ['idOwner','=',$idOwner],
            ['idDriver','=',$idDriver],
        ])->orderBy('posts.created_at','desc')
        ->paginate(10);
        
        //dd($posts);
        return view('owner.talkDetails',compact('posts','idDriver'));
    }

    
}
