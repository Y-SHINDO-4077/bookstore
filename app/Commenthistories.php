<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commenthistories extends Model
{
    protected $table = 'bookstore.commenthistories';
    
    protected $guarded = array('id');
    
    public static $rule = array(
        'store_id' => 'required',
        'comment_id' => 'required',
        'comments' => 'required',
        'edited_at' =>'required'
        );
        

}
