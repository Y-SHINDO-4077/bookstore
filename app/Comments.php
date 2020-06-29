<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //protected $table = 'bookstore.comments';
    
    protected $guarded = array('id');
    
    public static $rules = array(
        //'store_id' => 'required',
        'handdle_name' => 'required',
        'comment' => 'required',
       // 'user_id' => 'required'
        );
    //comment履歴と紐付け 2020.06.01    
    public function commenthistories(){
        return $this->hasMany('App\Commenthistories');
    }  
    //bookstoresと紐付け 2020.06.01
    public function bookstores(){
        return $this->belongsTo('App\Bookstores');
    }
     //usersとの連携
    public function users(){
        return $this->belongsTo('App\User');
    }
}
