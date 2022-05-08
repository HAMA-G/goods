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
    
    public function users()
    {
        return $this->hasOne('App\User','id','user_id');
    }
}
