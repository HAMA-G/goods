<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    // Validationの設定
    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',
        'status' => 'required',
        'description' => 'required',
    );
    
    //関連付け
    public function goods_tags()
    {
        return $this->hasMany('App\GoodsTags');
    }
}
