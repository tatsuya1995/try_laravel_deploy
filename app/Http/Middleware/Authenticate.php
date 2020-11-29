<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected $driver_route = 'driver.login';
    protected $owner_route = 'owner.login';
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        //ルーティングに応じて未ログイン時のリダイレクト先を振り分ける
        if (! $request->expectsJson()) {
            if(Route::is('driver.*')) {
                return route($this->driver_route);
            } elseif (Route::is('owner.*')){
                return route($this->owner_route);
            }

        }
    }
}
