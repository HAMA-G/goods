<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'goods';
    
    // Validationの設定
    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',
        'status' => 'required',
        'description' => 'required',
    );
    
    public function tags()
    {
        return $this->hasMany('App\Tag');
    }
    
    public function goods_tags()
    {
        return $this->hasMany('App\GoodsTag');
    }
}
