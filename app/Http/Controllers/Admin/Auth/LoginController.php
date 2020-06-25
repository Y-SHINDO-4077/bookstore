<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller\Admin\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
         $this->middleware('guest:admin')->except('logout');//変更
    }
    
    public function showLoginForm()
    {
        return view('admin.administer.administer');  //変更
    }
    
    public function login(){
        return view('admin.administer.home');
    }
 
    protected function guard()
    {
        return Auth::guard('guest:admin');  //変更
    }
    
    public function logout(Request $request)
    {
        Auth::guard('guest:admin')->logout();  //変更
        $request->session()->flush();
        $request->session()->regenerate();
 
        return redirect('/admin/login');  //変更
    }
}
