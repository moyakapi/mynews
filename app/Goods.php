<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $guarded = array('id');
     public static $rules = array(
        'name' => 'required',
        'detail' => 'required',
        'price' => 'required',
        'imgpath' => 'required',


    );
    

}
