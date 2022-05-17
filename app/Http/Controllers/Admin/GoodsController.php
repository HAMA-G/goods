<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Goods;
use App\User;
use App\Tag;
use App\GoodsTag;

class GoodsController extends Controller
{
    public function add()
    {
        $tags= Tag::all();
        return view('admin.goods.create', ['tags' => $tags]);
    }
    
    public function create(Request $request)
    {
        //validationの設定
        $this->validate($request, Goods::$rules);
        
        $goods = new Goods;
        $form = $request->all();
        
        // var_dump($form);
        // exit;
        
        $goods->user_id = Auth::id();
        
        if(isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $goods->image_path = basename($path);
        } else {
            $goods->image_path = null;
        }
        
        // $tags = $form['tags'];
        
        unset($form['_token']);
        unset($form['image']);
        unset($form['tags']);
        
        $goods->fill($form);
        $goods->save();
        
        $tags = $request->tags;
        if($tags != null){
            foreach($tags as $tag){
                $goods_tag = new GoodsTag();
                $goods_tag->goods_id = $goods->id;
                $goods_tag->tag_id = $tag;
                $goods_tag->save();
                
            }
        }
        
        
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
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if($cond_title != ''){
            $posts = Goods::where('title', $cond_title)->get();
        }else {
            $posts = Goods::all();
        }
        return view('admin.goods.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
}
