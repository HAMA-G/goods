<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>グッズ登録ページ</title>
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
                        <h2>グッズ新規登録</h2>
                        <form action="{{ action('Admin\GoodsController@create') }}" method="post" enctype="multipart/form-data">
                            @if (count($errors) > 0)
                                <ul>
                                    @foreach($errors->all() as $e)
                                        <il>{{ $e }}</il>
                                    @endforeach
                                </ul>
                            @endif
                            <div>
                                <label>商品名</label>
                                    <input type="text" name="name" value="{{ old('name') }}">
                            </div>
                            <div>
                                <label>購入状況</label>
                                    <input type="radio" name="status" value="1" {{ old('status') === '1' ? 'checked' : '' }} />購入済み
                                    <input type="radio" name="status" value="0" {{ old('status') === '0' ? 'checked' : '' }} />未購入
                            </div>
                            <div>
                                <label>タグ</label><br>
                                @foreach($tags as $tag)
                                    <label><input type="checkbox" name="tags[]" value="{{ ($tag->id) }}" {{ old($tag->id) === "true" ? 'checked' : '' }}>{{ $tag->name }}</label><br>
                                @endforeach
                            </div>
                            <div>
                                <label>テキスト</label>
                                    <textarea name="description" rows="20">{{ old('description') }}</textarea>
                            </div>
                            <div>
                                <label>商品画像</label>
                                    <input type="file" name="image">
                            </div>
                            {{ csrf_field() }}
                            <div>
                                <input type="submit" value="登録">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <footer>
            
        </footer>
    </body>
</html>