<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>トップページ</title>
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
                        @if (Route::has('login'))
                            <div class="top-right links">
                                @auth
                                    <a href="{{ url('/home') }}">Home</a>
                                @else
                                    <a href="{{ route('login') }}">Log in</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}">Sign in</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <h3>これは買ったけ？をなくす！</h3>
                    <h3>今日から始まるグッズ管理！</h3>
                </div>
                <div>
                    <!--例えばの画像-->
                </div>
                <div>
                    <ol>
                        <li>グッズを登録</li>
                        <li>タグんでカテゴリー分類</li>
                        <li>購入したものと、未購入のものを分けて管理</li>
                    </ol>
                </div>
            </div>
        <footer>
            
        </footer>
    </body>
</html>