<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Events\Pusher;
use App\Models\Driver;
use App\Models\Post;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Storage;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:driver');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $id = Auth::id();
        $driver = Driver::find($id);
        //dd($driver);
        return view('driver.show',compact('driver'));
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
        $idDriver = Auth::id();
        $driver = Driver::find($idDriver);
        
        // $pathDriver = $data['iconDriver']->store('public');
        // $iconDriver = basename($pathDriver);

        return view('driver.show',compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $idDriver = $id;
        $driver = Driver::find($idDriver);
        return view('driver.edit',compact('driver'));
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
        $driver = Driver::find($id);
        $driver->nameDriver = $request->input('nameDriver');
        $driver->email = $request->input('email');

        $iconDriver = $request->iconDriver;
        $pathIconDriver = Storage::disk('s3')->putFile('/iconDriver',$iconDriver,'public');
        $driver->iconDriver = Storage::disk('s3')->url($pathIconDriver);

        $driver->save();
        return redirect('driver/show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function searchIn()
    {
        return view('driver.search');
    }
    public function searchOut(Request $request)
    {   
        $request->validate([
            'departure' => 'required',
            'revert' => 'required|after:departure',
            'place' => 'required',
            'numPeople' => 'min:1',
        ]);

        $requestDep = $request->departure;
        $requestRev = $request->revert;
        $requestPla = $request->place;
        $requestNumPople = $request->numPeople;

        //検索
        $searches = DB::table('_owner_schedules')
        ->join('owners','_owner_schedules.idOwner','=','owners.id')
        ->where([
            ['departure','<=',$requestDep],
            ['revert','>=',$requestRev],
            ['place','=',$requestPla],
            ['numPeople','>=',$requestNumPople],
        ])->get();
        //dd($searches);
        return view('driver.search',compact('searches','request'));
    }

    public function talkIn(Request $request)
    {   
        //オーナー情報の表示
        $idOwner = $request->idOwner;
        $ownerInfo = DB::table('owners')->where('id','=',$idOwner)->first();
        
        //ドライバー情報の表示
        $idDriver = Auth::id();
        $driverInfo = DB::table('drivers')->where('id','=',$idDriver)->first();
        //投稿内容の表示
        // $posts = DB::table('posts')->where([
        //     ['idOwner','=',$idOwner],
        //     ['idDriver','=',$idDriver],
        // ])->orderBy('created_at','desc')
        // ->paginate(10);
        //ドライバー、オーナー区別するトライ
        $param = [
            'idOwner' => $idOwner,
            'idDriver' => $idDriver,
        ];
        // $query = DB::table('chats')->where([
        //     ['idOwner','=',$idOwner],
        //     ['idDriver','=',$idDriver],
        // ]);
        $query = Chat::where('idOwner' , $idOwner)->where('idDriver', $idDriver);
        $query->orWhere(function($query) use($idOwner,$idDriver){
            $query->where('idOwner',$idOwner);
            $query->where('idDriver',$idDriver);
        });
        $posts = $query->get();
        return view('driver/talk',compact('ownerInfo','driverInfo','posts'));
    }
    // public function talkOut(Request $request)
    // {
    //     return view('talk');
    // }
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

    //     //投稿内容の保存
    //     $idOwner = $request->idOwner;
    //     $post = new Post;
    //     $post->comment = $request->input('comment');
    //     $post->idOwner = $request->input('idOwner');
    //     $post->idDriver = Auth::id();
    //     $post->save();
    //     //return redirect('driver.talk',['idOwner' => $idOwner]);
    //     return redirect()->action('Driver\HomeController@talkIn',['idOwner' => $idOwner]);
    }
    public function deletePost(Request $request)
    {   
        $idOwner = $request->idOwner;
        $idPost = $request->id;
        $post = Post::find($idPost);
        $post->delete();
        return redirect()->action('Driver\HomeController@talkIn',['idOwner' => $idOwner]);
    }
}
