<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Contract;
use App\Events\Pusher;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
class CommonController extends Controller
{

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
        $chats = Chat::all();
        return view('/pusher',["chats" => $chats]);
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
    }    
    public function finalContract()
    {
        $contracts = Contract::orderBy('created_at','desc')->get();
        return view('Administrator/final_contract',compact('contracts'));
    }
}
