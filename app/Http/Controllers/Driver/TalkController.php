<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Events\Pusher;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class TalkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pusherGet()
    {   
        $chats = Chat::all();
        return view('driver/pusher',["chats" => $chats]);
    }

    public function pusherCreate(Request $request):JsonResponse
    {   
        //dd($request);
        //Eloquet モデル
        $chat = new Chat($request->all());
        $chat->save();
        //pusherの処理
        event(new Pusher($chat));
        return response()->json(['message' => '投稿しました。']);

    //     return view('/pusher',["chats" => $chats]);
    }
}
