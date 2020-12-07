<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('/index');
    }
    
    public function qa()
    {
        return view('/qa');
    }
    
    public function select()
    {
        return view('/select');
    }
    
    public function pusherGet()
    {
        return view('/pusher');
    }

    public function pusherStore(Request $request)
    {   
        //Eloquetn モデル
        $chats = new Chat;
        $chats->comment = $request->comment;
        $posts->save();
        //pusherの処理
        event(new PusherEvent($chats));
        //return view('/pusher');
    }
}
