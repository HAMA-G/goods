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
        
        $goods->user_id = Auth::id();
        
        if(isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $goods->image_path = basename($path);
        } else {
            $goods->image_path = null;
        }
        
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
        
        return redirect('admin/goods');
    }
    
    public function edit(Request $request)
    {
        $goods = Goods::find($request->id);
        if(empty($goods)) {
            abort(404);
        }
        
        $tags= Tag::all();
        
        return view('admin.goods.edit', ['goods_form' => $goods], ['tags' => $tags]);
    }
    
    public function update(Request $request)
    {
        $this->validate($request, Goods::$rules);
        $goods = Goods::find($request->id);
        
        $goods_form = $request->all();
        
        if($request->remove == 'true'){
            $goods_form['image_path'] = null;
        }elseif($request->file('image')){
            $path = $request->file('image')->store('public/image');
            $goods_form['image_path'] = basename($path);
        }else{
            $goods_form['image_path'] = $goods->image_path;
        }
        
        
        if($request->tags != null){
            foreach($tags as $tag){
                
            }
        }
        
        unset($goods_form['image']);
        unset($goods_form['remove']);
        unset($goods_form['_token']);
        
        $goods->fill($goods_form)->save;
        
        $tags = $request->tags;
        foreach($tags as $tag) {
            $goods_tag = GoodsTag::find($request->id);
            $goods_tag->tag_id = $tag;
        }
        
        return redirect('admin/goods');
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
