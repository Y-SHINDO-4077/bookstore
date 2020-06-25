<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;//2020.06.21 仮登録確認画面へ遷移のために追加
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

//2020.06.24 セッションにメール情報を入れる
use Session;
//現在日時の設定 2020.06.25
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    
    //protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    
    //新規登録画面で登録クリック後、確認画面へ遷移 2020.06.21
    public function pre_check(Request $request){
        $this->validator($request->all())->validate();
        
        $request->flashOnly('email');
        $bridge_request = $request->all();
        
        //passwordマスキング
        $bridge_request['password_mask'] = '********';
        
        return view('auth.register_check')->with($bridge_request);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $date = Carbon::now();
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'sent_at' => $date->toDateTimeString(),
        ]);
        
        // $user = User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        //     'email_verify_token' => base64_encode($data['email']),
        // ]);
            
        // $email = new EmailVerification($user);
        // Mail::to($user->email)->send($email);
        
        // return $user;
    }
    
    
    public function register(Request $request)
    {
        event(new Registered($user = $this->create( $request->all() )));
        //再送メール用にセッションに情報を保存
        if($request->email){
            $email =$request->email;
            Session::put('email',$email);
        }
        //var_dump($email);
        return view('auth.pre_registered',compact('email'));
    }
}
