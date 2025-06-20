@extends('layouts.users-layout')


@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

@section('button')
<a class="move__register-screen" href="/register">register</a>
@endsection

@section('content')
<div class="login-form__content">
    <h2 class="login-form__heading">
        Login
    </h2>
    <form class="login-form__form" action="/login" method="post" novalidate>
        @csrf
        <div class="login-form__group-wrap">
            <div class="login-form__group-part">
            <div class="login-form__group-part">
                <div class="login-form__group-title">
                    <span class="login-form__label--item">メールアドレス</span>
                </div>
                <div class="login-form__group-content">
                    <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                </div>
                <div class="login-form__group-error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="login-form__group-part">
                <div class="login-form__group-title">
                    <span class="login-form__label--item">パスワード</span>
                </div>
                <div class="login-form__group-content">
                    <input type="password" name="password" placeholder="例: coachtech1106">
                </div>
                <div class="login-form__group-error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="login-form__button">
            <button class="login-form__button--submit">
                ログイン
            </button>
        </div>
    </form>
</div>
@endsection