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

    public function finalContract()
    {
        $contracts = Contract::orderBy('created_at','asc')->get();
        return view('Administrator/final_contract',compact('contracts'));
    }
}
