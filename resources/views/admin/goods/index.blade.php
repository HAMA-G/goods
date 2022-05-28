<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>登録一覧ページ</title>
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
                        <h2>登録済みグッズ一覧</h2>
                        <a href="{{ action('Admin\GoodsController@add') }}" role="button">新規作成</a>
                        <form action="{{ action('Admin\GoodsController@index') }}" method="get" enctype="multipart/form-data">
                            <div>
                             <label>検索・ソート</label>
                                <input type="text" name="search" value="{{ $search }}">
                                <input type="radio" name="sort" value="asc">昇順
                                <input type="radio" name="sort" value="desc">降順
                                <input type="submit" value="実行">
                                <button>
                                    <a href="{{action('Admin\GoodsController@index') }}">クリア</a>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>グッズ名</th>
                                    <th>説明</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $goods)
                                    <tr>
                                        <th>{{ $goods->id }}</th>
                                        <td>{{ \Str::limit($goods->name, 50) }}</td>
                                        <td>{{ \Str::limit($goods->description, 200) }}</td>
                                        <td><a href="{{ action('Admin\GoodsController@edit', ['id' => $goods->id]) }}">編集</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <footer>
            
        </footer>
    </body>
</html>