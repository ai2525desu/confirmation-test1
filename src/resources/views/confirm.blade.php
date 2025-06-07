@extends('layouts.contact')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('content')
<div class="confirm__content">
    <h2 class="confirm__heading">
        Confirm
    </h2>
    <!-- action method後で追加 -->
    <form class="confirm__form" action="/thanks" method="post">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                        <!-- もともとfullnameという名前で出力していたが、このままでは修正時の妨げになるとのこと
                        <input type="text" name="fullname" value="{{ $contact['last_name'] }}{{ $contact['first_name'] }}" readonly> -->
                        <!-- 下記にinputをhiddenにしたので、姓名を表示指せるように追記 -->
                        <span class="confirm-table__text--name"> {{$contact['last_name']}} {{$contact['first_name']}}</span>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        <!-- <input type="text" name="gender" value="{{ $contact['gender'] }}" readonly> -->
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}"  readonly>
                        <span class="confirm-table__text--gender">
                        @if ($contact['gender'] == '1') 
                        男性
                        @elseif ($contact['gender'] == '2')
                        女性
                        @else ($contact['gender'] == '3')
                        その他
                        @endif
                        </span>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        <input type="email" name="email" value="{{ $contact['email'] }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        <!-- 入力時に三つに分割したものを一つにまとめて表示する必要あり -->
                        <input type="tel" name="tel" value="{{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        <input type="text" name="address" value="{{ $contact['address'] }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <input type="text" name="building" value="{{ $contact['building'] }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <!-- ここでは、リレーションして送信された$categoryの内容を表現する必要がある -->
                    <td class="confirm-table__text">
                        <input type="text" name="category_content" value="{{ $contact['category_content'] }}" readonly>
                        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly>
                    </td>
                </tr>
            </table>
        </div>
        <div class="confirm-form__button">
            <button class="confirm-form__button--submit" name="submit" value="submit">
                送信
            </button>
            <!-- 5/30お問い合わせフォームに戻ることはできるが、修正内容の値が保持されていない問題発生中 -->
            <form action="/confirm" method="post">
                <button class="confirm-form__button--fix" name="back" value="back">
                    修正
                </button>
            </form>
        </div>
    </form>
</div>
@endsection