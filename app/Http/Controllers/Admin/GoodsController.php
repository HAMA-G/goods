<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Goods;
use App\User;

class GoodsController extends Controller
{
    public function add()
    {
        return view('admin.goods.create');
    }
    
    public function create(Request $request)
    {
        //validationの設定
        $this->validate($request, Goods::$rules);
        
        $goods = new Goods;
        $form = $request->all();
        
        $goods->user_id = Auth::id();
        
        if(isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $goods->image_path = basename($path);
        } else {
            $goods->image_path = null;
        }
        
        unset($form['_token']);
        unset($form['image']);
        
        $goods->fill($form);
        $goods->save();
        
        //動作確認のために設定している。今後はメインページに飛ぶように変える
        return redirect('admin/goods/create');
    }
    
    public function edit()
    {
        return veiw('admin.goods.edit');
    }
    
    public function update()
    {
        return redirect('admin/goods/index');
    }
}
