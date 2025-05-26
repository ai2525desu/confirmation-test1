<?php
// お問い合わせの種類の部分に通じる
$categories = ['問い合わせの種類１', '問い合わせの種類２'];

foreach ($categories as $category) {
    echo $category;
}
?>

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="contact-form__content">
    <h2 class="contact-form__heading">
        Contact
    </h2>
    <form class="form" action="" method="">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <!-- 姓と氏名分かれて別枠のため、divで区切ってflex予定 -->
            <div class="form__group-content">
                <div class="form__input--name">
                    <div class="form__input--last_name">
                        <input type="text" name="last_name" placeholder="例:山田" value="{{ old('last_name') }}">
                    </div>
                    <div class="form__input--first_name">
                        <input type="text" name="first_name" placeholder="例:太郎" value="{{ old('first_name') }}">
                    </div>
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--radio">
                    <input type="radio" name="gender" value="男性" checked><label>男性</label>
                    <input type="radio" name="gender" value="女性"><label>女性</label>
                    <input type="radio" name="gender" value="その他"><label>その他</label>
                </div>
                <div class="form__error">
                    @error('gender')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="例:test@example.com" value="{{ old('email') }}">
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--tel">
                    <input type="tel" name="tel1" placeholder="080" value="{{ old('tel1') }}">
                    <div>-</div>
                    <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
                    <div>-</div>
                    <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
                </div>
                <div class="form__error">
                    @error('tel')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                </div>
                <div class="form__error">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101" value="{{ old('building') }}">
                </div>
                <div class="form__error">
                    @error('building')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--category">
                    <!-- クラス名、わかりにくいか？のちにname追加予定 -->
                    <select class="form__input--select" name="">
                        <option value="" disabled selected style="display:none">選択してください</option>
                        @foreach ($categories as $category)
                        <!-- 05262233：phpにて定義した物を表示中、リレーション後category_idとnameに変更予定 -->
                        <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                        @endforeach
                    </select>
                </div>
                <div class="form__error">
                    @error('category')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="content" placeholder="お問い合わせ内容をご記載ください" value="{{ old('content') }}"></textarea>
                </div>
                <div class="form__error">
                    @error('content')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button--submit">確認画面</button>
        </div>
    </form>
</div>


@endsection