<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
     
     //2020.06.13 protected route追加
    //  protected $user_route  = 'user.login';
    protected $admin_route = 'admin.login';

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
        
         // ルーティングに応じて未ログイン時のリダイレクト先を振り分ける 2020.06.13
        // if (!$request->expectsJson()) {
        //     if (Route::is('user.*')) {
        //         return route($this->user_route);
        //     } elseif (Route::is('admin.*')) {
        //         return route($this->admin_route);
        //     }
        // }
    }
}
