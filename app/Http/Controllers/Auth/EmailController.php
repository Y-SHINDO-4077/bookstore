<?php
/**
     * メール認証email対応用のもの。
     * /illuminate/Routing/Router.php 
     * public function emailVerification()のRoute::getをこちらに変更。
     * Auth/Verificationcontorollerからでは無い。
     * 2020.06.22
     * 
     */

namespace App\Http\Controllers\Auth;

use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//2020/06/24追加
use Illuminate\Auth\Events\Verified;//追加
use Illuminate\Foundation\Auth\VerifiesEmails;//追加
use Illuminate\Contracts\Auth\MustVerifyEmail;//追加
use Illuminate\Auth\Access\AuthorizationException;//追加
use App\User;//追加
use Session;//追加
use Carbon\Carbon;//追加



class EmailController extends Controller
 

{
    use VerifiesEmails;

    public function verify(Request $request){
        $user = User::find($request->id);
        
        
        //有効期限１時間後の時間の取得
        $date_now = new Carbon(Carbon::now());
        $date_expire = Carbon::createFromFormat('Y-m-d H:i:s', $user->sent_at);
        $date_expire->addHour();
        //リンクの有効期限のチェック
        if($date_now->gt($date_expire)){ //gtは大きいと言う意味
        
        //セッション情報にemailが残っていれば、取得する
        if(Session::has('email')){
            $user = Session::get('email');
        }else{
            $user = Session::get('email','');
            //print_r($user);
        }
            return view('auth.verify_main',compact('user'))
            ->with('warning','メールリンクの有効期限（1時間)を過ぎました。認証が必要です。');
            
        }
        
        //idが一致していなければリンクは無効になる
       if ($request->route('id') != $user->getKey()){
           throw new AuthorizationException;
       }
       //email_verified_atを現在日時へ更新、認証済にする。
       if($user->markEmailAsVerified()){
           event(new Verified($request->user()));
       }
       //emailセッションがあれば、セッションをなくす
       if(session()->has('email')){
       session()->forget('email');
       }
        
        return view('auth.verify_main');
    }
   
        /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend()
    {
        //sessionにemail情報を入れておく。遷移後テキストに入るように。2020.06.24
        if(Session::has('email')){
            $user = Session::get('email');
            $users = User::where('email',$user)->first();
        }else{
            $user = Session::get('email','');
        }
        
        //$users = User::where('email',$user)->first();
       
        return view('auth.verify_resend',compact('user'));
    }
    /*確認メールの再送信 2020.06.23 */
    public function postresend(Request $request){
        $user = User::where('email',$request->email)->first();
        //emailが登録されていない場合、アラート
        if(!$user){
            return redirect('/email/resend')
            ->with('warning','登録されていないアドレスです。');
        }
        //email_verified_atに値が入っていれば認証されていることになる。送信不要。
        if($user->email_verified_at != null){
            return redirect('/email/resend')
              ->with('warning','すでにメール認証済みです。ログイン画面よりログインしてください。');
        }
        //メール送信
        $user->sendEmailVerificationNotification();
        //sent_atの時間を更新する
        $user->sent_at = Carbon::now();
        $user->save();
        return redirect('email/resend')->with('warning','本登録メールを再送しました。ご確認ください。');
    }

}
