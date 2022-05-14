<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //Validationの設定
    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',
    );
    
    public function goods_tags()
    {
        return $this->hasMany('App\GoodsTag');
    }
}
