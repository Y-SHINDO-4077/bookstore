<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookstores extends Model
{   
    //protected $table ='bookstore.bookstores';
    
    protected $guarded =array('id');
    
    public static $rules = array(
        'name' => 'required | unique:bookstores',
        'region' => 'required',
        'pref' => 'required',
        'address' => 'required'
        );
    //bookstorehistoryとの連携    
    public function bookstorehistories (){
        return $this->hasMany('App\BookstoreHistores');
    }
    //usersとの連携
    public function users(){
        return $this->belongsTo('App\User');
    }
    
}

