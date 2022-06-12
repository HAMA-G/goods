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
    
    public function tag()
    {
        return $this->belongsTo('App\Tag')->first();
    }
    
    public function goods()
    {
        return $this->belongsTo('App\Goods', 'goods_id')->first();
    }
    
}
