@extends('layouts.users-layout')


@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

<!-- ＠section('button', 'regster')にしたら自動的に文字が入るのではと予想したが、一応下記のままでやってみる -->
@section('button')
<a class="move__register-screen" href="/login">login</a>
@endsection

@section('content')
<div class="register-form__content">
    <h2 class="register-form__heading">
        Register
    </h2>
    <form class="register-form__form">
        @csrf
        <div class="register-form__group-wrap">
            <div class="register-form__group-part">
                <div class="register-form__group-title">
                    <span class="register-form__label--item">お名前</span>
                </div>
                <div class="register-form__group-content">
                    <input type="text" name="name" placeholder="例: 山田 太郎">
                </div>
                <div class="register-form__group-error">
                @error('name')
                {{ $message }}
                @enderror
                </div>
            </div>
            <div class="register-form__group-part">
                <div class="register-form__group-title">
                    <span class="register-form__label--item">メールアドレス</span>
                </div>
                <div class="register-form__group-content">
                    <input type="email" name="email" placeholder="例: test@example.com">
                </div>
                <div class="register-form__group-error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="register-form__group-part">
                <div class="register-form__group-title">
                    <span class="register-form__label--item">パスワード</span>
                </div>
                <div class="register-form__group-content">
                    <input type="passwprd" name="password" placeholder="例: coachtech1106">
                </div>
                <div class="register-form__group-error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="register-form__button">
            <button class="register-form__button--submit">
                登録
            </button>
        </div>
    </form>
</div>
@endsection