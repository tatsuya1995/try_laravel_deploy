<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Contract extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nameDriver',
        'nameOwner',
        'dateDeparture',
        'timeDeparture',
        'dateRevert',
        'timeRevert',
        'nameCar',
        'numPeople',
        'carNumber',
        'subTotal',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];
}
