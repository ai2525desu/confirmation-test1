@extends('layouts.app')

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
                <div class="form__input--last_name">
                    <input type="text" name="last_name" placeholder="例:山田" value="">
                </div>
                <div class="form__input--first_name">
                    <input type="text" name="first_name" placeholder="例:太郎" value="">
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
                    <input type="radio" name="gender" value="男性" checked>男性
                    <input type="radio" name="gender" value="女性">女性
                    <input type="radio" name="gender" value="その他">その他
                </div>
            </div>
        </div>
    </form>
</div>


@endsection