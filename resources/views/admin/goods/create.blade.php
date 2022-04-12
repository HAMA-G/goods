{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'商品新規登録'を埋め込む --}}
@section('title', 'グッズの新規登録')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>グッズの新規登録</h2>
            </div>
        </div>
    </div>
@endsection