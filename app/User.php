<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;



//本登録メール・PWリセットメール対応2020.06.22
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\MustVerifyEmail;
use App\Notifications\CustomVerifyEmail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Notifications\VerifyEmailJa;//vendor対策用2020.06.30
use App\Notifications\JaPasswordReset;//vendor対策用2020.06.30;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'sent_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

    ];
    
     /**
     * The attributes that are gureded 2020.06.29
     * @var array
     */
    protected $guarded = [
        'admin'
    ];
    
    //2020.06.22 新規登録用
    public function sendEmailVerificationNotification(){
        //$this->notify(new VerifyEmail);
        $this->notify(new VerifyEmailJa);
    }
    //2020.06.22 パスワード再確認用
    public function sendPasswordResetNotification($token){
        //$this->notify(new ResetPassword($token));
        $this->notify(new JaPasswordReset($token));
    }
}

