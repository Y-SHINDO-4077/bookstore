<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//メール認証できているかの確認 2020.06.24
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
         //$this->middleware('guest:admin')->except('logout');
    }
    
    /** メール認証が行われているのかどうかによって、ログインできるできないを変更
    *　　email_verified_atがnullならメール認証が必要。 2020.06.24
    */
    public function authenticated(Request $request,$user){
       if($user->email_verified_at == NULL || $user->email_verified_at =''){
           //Illuminate/Foundation/AuthenticatesUsers.php のlogout()に従い、ログアウト処理。
           $this->guard()->logout();
           $request->session()->invalidate();
           return redirect('/login')->with('warning','メール認証が行われていません。メールをご確認ください。');
       }   
    }
}
