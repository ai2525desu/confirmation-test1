@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('content')
<div class="confirm__content">
    <h2 class="confirm__heading">
        Confirm
    </h2>
    <!-- action method後で追加 -->
    <form class="confirm__form" action="" method="">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        <!-- 姓名別でlast__name,first__nameで送信されたものをfullnameにして表示。value内部は姓名それぞれデータを取得して表示する必要あり$contact['last__name']. "  " .$contact['first__name']みたいなイメージ？ -->
                        <input type="text" name="fullname" value="例：山田  太郎" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        <input type="text" name="gender" value="例：男性" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        <input type="email" name="email" value="例：test@example.com" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        <!-- 入力時に三つに分割したものを一つにまとめて表示する必要あり -->
                        <input type="tel" name="tel" value="例：080012345678" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        <input type="text" name="address" value="例:東京都渋谷区千駄ヶ谷1-2-3" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <input type="text" name="building" value="例:千駄ヶ谷マンション101" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <!-- ここでは、リレーションして送信された$categoryの内容を表現する必要がある -->
                    <td class="confirm-table__text">
                        <input type="text" name="category" value="例:商品交換について" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        <input type="text" name="content" value="例:お問い合わせ内容" readonly>
                    </td>
                </tr>
            </table>
        </div>
        <div class="confirm-form__button">
            <button class="confirm-form__button-submit confirm-form__button--send">
                送信
            </button>
            <button class="confirm-form__button-submit confirm-form__button--fix">
                修正
            </button>
        </div>
    </form>
</div>
@endsection