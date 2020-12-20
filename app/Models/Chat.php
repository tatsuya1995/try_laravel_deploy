<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Chat extends Model
{
    protected $fillable = [
        'comment'
    ];
    //タイムスタンプの自動更新
    public $timestamps = true ;
}
