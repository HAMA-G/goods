<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodsTag extends Model
{
    //Validationの設定
    protected $guarded = array('id');
    
    public static $rule = array(
        'goods_id' => 'required',
        'tag_id' => 'required',
    );
}
