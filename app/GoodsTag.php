<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodsTag extends Model
{
    //Validationの設定
    protected $guarded = array('id');

    public static $rules = array(
        'goods_id' => 'required',
        'tag_id' => 'required',
    );
    
    public function tags()
    {
        return $this->hasMany('App\Tag');
    }
}
