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
    
    public function goods_tags()
    {
        return $this->hasMany('App\GoodsTag');
    }
    
    public function isCheckedTag($tag_id)
    {
        if($this->goods_tags()->where("tag_id", $tag_id)->first() != null){
            return true;
        } else{
            return false;
        }
    }
    
    public function checkedTag($tag_id)
    {
        if($this->isCheckedTag($tag_id)){
            return "checked";
        }else{
            return "";
        }
    }
}
