@extends('layouts.admin-layout')


@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

<!-- ＠section('button', 'regster')にしたら自動的に文字が入るのではと予想したが、一応下記のままでやってみる -->
@section('button')
<a class="move__register-screen" href="/register">register</a>
@endsection

@section('content')
<div class="login-form__content">
    <div class="login-form__heading">
        <h2>Login</h2>
    </div>
</div>
@endsection