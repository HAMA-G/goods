<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>グッズ編集ページ</title>
        <link rel="stylesheet" href="register_page.css">
    </head>
    <body>
        <header>
            <div class="nav-container">
                <div class="navigationbar-logo">
                    <p class="logo">MGC</p>
                </div>
                <div class="header-title-area">
                    <h1 class="title-name">My Goods Collection</h1>
                </div>
            </div>
        </header>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <h2>グッズ編集</h2>
                        <form action="{{ action('Admin\GoodsController@update') }}" method="post" enctype="multipart/form-data">
                            @if (count($errors) > 0)
                                <ul>
                                    @foreach($errors->all() as $e)
                                        <il>{{ $e }}</il>
                                    @endforeach
                                </ul>
                            @endif
                            <div>
                                <label>商品名</label>
                                    <input type="text" name="name" value="{{ $goods_form->name }}">
                            </div>
                            <div>
                                <label>購入状況</label>
                                    <input type="radio" name="status" value="1" {{ $goods_form->status === '1' ? 'checked' : '' }} />購入済み
                                    <input type="radio" name="status" value="0" {{ $goods_form->status === '0' ? 'checked' : '' }} />未購入
                            </div>
                            <div>
                                <label>タグ</label><br>
                                @foreach($tags as $tag)
                                    <label><input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ $goods_form->checkedTag($tag->id) }}>{{ $tag->name }}</label><br>
                                @endforeach
                            </div>
                            <div>
                                <label>テキスト</label>
                                    <textarea name="description" rows="20">{{ $goods_form->description }}</textarea>
                            </div>
                            <div>
                                <label>商品画像</label>
                                    <input type="file" name="image">
                                    <div>
                                        {{ $goods_form->image_path }}
                                    </div>
                            </div>
                            <div>
                                <label><input type="checkbox" name="remove" value="true">画像を削除</label>
                            </div>
                            <div>
                                <input type="hidden" name="id" value="{{ $goods_form->id }}">
                            </div>
                            {{ csrf_field() }}
                            <div>
                                <input type="submit" value="更新">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <footer>
            
        </footer>
    </body>
</html>