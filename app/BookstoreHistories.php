<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class BookstoreHistories extends Model
{
    protected $guarded =array('id');
    
    public static $rules= array(
        'bookstore_id'=>'required',
        'edited_at' => 'required'
        );
}
