@extends('layouts.contact')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('content')
<div class="confirm__content">
    <h2 class="confirm__heading">
        Confirm
    </h2>
    <form class="confirm__form" action="/thanks" method="post">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        {{$contact['last_name']}}&nbsp;{{$contact['first_name']}}
                    </td>
                    <!-- もともとfullnameという名前で出力していたが、このままでは修正時の妨げになるとのこと
                    <input type="text" name="fullname" value="{{ $contact['last_name'] }}{{ $contact['first_name'] }}" readonly> -->
                    <!-- 下記にinputをhiddenにしたので、姓名を表示指せるように追記 -->
                    <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                    <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        @if ($contact['gender'] == '1') 
                        男性
                        @elseif ($contact['gender'] == '2')
                        女性
                        <!-- elseには条件分はつけられない -->
                        @else
                        その他
                        @endif
                    </td>
                    <!-- <input type="text" name="gender" value="{{ $contact['gender'] }}" readonly> -->
                    <input type="hidden" name="gender" value="{{ $contact['gender'] }}"  readonly>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        メールアドレス
                    </td>
                    <!-- 自身：<input type="email" name="email" value="{{ $contact['email'] }}" readonly> -->
                    <!-- 解答：hidden -->
                    <input type="hidden" name="email" value="{{ $contact['email'] }}" readonly>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        {{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}
                    </td>
                    <!-- 入力時に三つに分割したものを一つにまとめて表示する必要ありだが、下記をひとまとめにすると修正時に問題あり
                    <input type="tel" name="tel" value="{{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}" readonly>
                    -->
                    <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
                    <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
                    <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        {{ $contact['address'] }}
                    </td>
                    <!-- <input type="text" name="address" value="{{ $contact['address'] }}" readonly> -->
                    <input type="hidden" name="address" value="{{ $contact['address'] }}" readonly>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        {{ $contact['building'] }}
                    </td>
                    <!-- <input type="text" name="building" value="{{ $contact['building'] }}" readonly> -->
                    <input type="hidden" name="building" value="{{ $contact['building'] }}" readonly>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        {{ $contact['category_content'] }}
                    </td>
                    <!-- <input type="text" name="category_content" value="{{ $contact['category_content'] }}" readonly>
                        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}"> -->
                    <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        {{ $contact['detail'] }}
                    </td>
                    <!-- <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly> -->
                    <input type="hidden" name="detail" value="{{ $contact['detail'] }}" readonly>
                </tr>
            </table>
        </div>
        <div class="confirm-form__button">
            <!-- 自身で作成
              <button class="confirm-form__button--submit" name="submit" value="submit">
                送信
            </button>
            5/30お問い合わせフォームに戻ることはできるが、修正内容の値が保持されていない問題発生中
            <form action="/confirm" method="post">
                <button class="confirm-form__button--fix" name="back" value="back">
                    修正
                </button>
            </form> -->
            <input class="confirm-form__button--send" type="submit" name="send" value="送信">
            <input class="confirm-form__button--back" type="submit" name="back" value="修正">
        </div>
    </form>
</div>
@endsection