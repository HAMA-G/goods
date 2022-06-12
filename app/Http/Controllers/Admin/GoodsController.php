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
        
        return view('admin.goods.edit', ['goods_form' => $goods, 'tags' => $tags]);
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
        
        // requestでtagsがあった場合、新しいものを保存する
        // tagsがなかった場合はそのまま
        // 新しく追加された場合は、goods_idにtag_idを新しく紐付ける
        // チェックをなくした場合は、goods_idとtag_idの紐付けを削除する
        
        unset($goods_form['image']);
        unset($goods_form['remove']);
        unset($goods_form['_token']);
        unset($goods_form['tags']);
        
        $goods->fill($goods_form)->save();
        
        $goods_tag = GoodsTag::find($request->id);
        var_dump($goods_tag);
        
        // $tags = $request->tags;
        // if($tags != null && $goods_tag->where("tag_id", $tag_id)->first() == null){
        //     foreach($tags as $tag){
        //         $goods_tag = new GoodsTag();
        //         $goods_tag->goods_id = $goods->id;
        //         $goods_tag->tag_id = $tag;
        //         $goods_tag->save();
        //     }
        // }elseif($tags != null && $goods_tag->where("tag_id", $tag_id)->first() != null){
        //     $goods_tag->save();
        // }elseif($tags == null && $goods_tag->where("tag_id", $tag_id)->first() != null){
        //             $goods_tag = null;
        //             $goods_tag->save();
        // }else{
        //     $goods_tag->save();
        // }
            
        return redirect('admin/goods/create');
    }
    
    public function index(Request $request)
    {
        $search = $request->search;
        
        $posts = null;
        
        $tags = Tag::all();
        
        
        if(!empty($search)){
            // 全角スペースを半角スペースに変換する
            $spaceConversion = mb_convert_kana($search, 's');
            // 単語を半角す～エスで区切り、配列にする
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            
            if($request->sort == "desc"){
                $posts = Goods::where('user_id', Auth::id());
                // 単語をループで回し、ユーザーネームと部分一致するものがあれば、$queryとして保存される
                foreach($wordArraySearched as $search){
                     $posts->where(function($query) use($search){$query->where('name','like', "%".$search."%")
                                  ->orwhere('description', 'like', "%".$search."%");});
                }
                $posts->orderBy("id", "desc");
            }else {
                $posts = Goods::where('user_id', Auth::id());
                // 単語をループで回し、ユーザーネームと部分一致するものがあれば、$queryとして保存される
                foreach($wordArraySearched as $search){
                      $posts->where(function($query) use($search){$query->where('name','like', "%".$search."%")
                      ->orwhere('description', 'like', "%".$search."%");});
                }
                $posts->orderBy("id", "asc");
            }
        }elseif(!empty($request->sort)){
            if($request->sort == "desc"){
                $posts = Goods::where('user_id', Auth::id())
                              ->orderBy("id", "desc");
            }else {
                $posts = Goods::where('user_id', Auth::id())
                              ->orderBy("id", "asc");
            }
        }
        
        if($posts == null){
            $posts = Goods::where('user_id', Auth::id());
        }
        // var_dump($request->tags);
        //タグが指定されていた場合
        $goods_ids = [];
        if(!empty($request->tags)){
            $goods_tag = GoodsTag::whereIn('tag_id', $request->tags)->get();
            foreach($goods_tag->groupBy('goods_id') as $id=>$v){
                $goods_ids[] = $id;
            }
            var_dump($goods_ids);
            
            if(!empty($goods_ids)){
                $posts = $posts->whereIn('id', $goods_ids); 
            }else{
                $posts = Goods::where('user_id', 0);
            }
        //グッズタグから指定されたものを取り出す
        //     $goods_tag = goods_tags()->where('tag_id', $tag->id)->get();
        //次にグッズタグから取り出されたものをグッズに指定する
        //     $posts = Goods::where('id', $goods_tag->goods_id)->get();
        }
        
        
        $posts = $posts->get();
        
        
        
        
        
        
        
        
        return view('admin.goods.index', ['posts'=>$posts, 'search'=>$search, 'tags'=>$tags]);
    }
}
