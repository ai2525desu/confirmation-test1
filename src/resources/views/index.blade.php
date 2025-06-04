<!-- ＜?php
// お問い合わせの種類の部分に通じる
$categories = ['問い合わせの種類１', '問い合わせの種類２'];

foreach ($categories as $category) {
    echo $category;
}

?> -->

@extends('layouts.contact')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="contact-form__content">
    <h2 class="contact-form__heading">
        Contact
    </h2>
    <!-- 20250528:修正時にold関数の第二引数でデータベースに保存する変数とキーを用いて画面を更新後推移しても更新前の値が残るように設定。$contact->キー名,genderとcategoryの部分がわからず未設定状態 -->
    <form class="form" action="/confirm" method="post">
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
                        <input type="text" name="last_name" placeholder="例:山田" value="{{ old('last_name'), $contact->last_name }}">
                    </div>
                    <div class="form__input--first_name">
                        <input type="text" name="first_name" placeholder="例:太郎" value="{{ old('first_name'), $contact->first_name }}">
                    </div>
                </div>
                <div class="form__error--name">
                    <div class="last-name">
                        @error('last_name')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="first-name">
                        @error('first_name')
                        {{ $message }}
                        @enderror
                    </div>
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
                    <input type="radio" name="gender" value="1" {{ old('gender', $contact->gender ?? '') == '1' ? 'checked' : '' }} checked><label>男性</label>
                    <input type="radio" name="gender" value="2" {{ old('gender', $contact->gender ?? '') == '2' ? 'checked' : '' }}><label>女性</label>
                    <input type="radio" name="gender" value="3" {{ old('gender', $contact->gender ?? '') == '3' ? 'checked' : '' }}><label>その他</label>
                </div>
                <div class="form__error--radio">
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
                    <input type="email" name="email" placeholder="例:test@example.com" value="{{ old('email'), $contact->email }}">
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
                    <input type="tel" name="tel1" placeholder="080" value="{{ old('tel1'), $contact->tel1 }}">
                    <div>-</div>
                    <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2'), $contact->tel2 }}">
                    <div>-</div>
                    <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3'), $contact->tel3 }}">
                </div>
                <div class="form__error">
                    @error('tel1')
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
                    <input type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address'), $contact->address }}">
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
                    <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101" value="{{ old('building'), $contact->building }}">
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
                    <select class="form__input--select" name="category_id">
                        <!-- <option value="" disabled selected style="display:none">選択してください</option> -->
                        <option value="" disabled {{ old('category_id', $contact->category_id ?? '') == '' ? 'selected' : '' }}>選択してください</option>
                        @foreach ($categories as $category)
                        <option value="{{ ($category['id'])}}" {{ old('category_id', $contact->category_id ?? '') == $category['id'] ? 'selected' : '' }}>
                            {{ $category['content'] }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form__error">
                    @error('category_id')
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
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail'), $contact->detail }}</textarea>
                </div>
                <div class="form__error">
                    @error('detail')
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