@extends('layouts.admin-layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('button')
<form class="logout-form__button" action="/logout" method="post">
    @csrf
    <button class="logout-form__button--submit">
        logout
    </button>
</form>
@endsection

@section('content')
<div class="admin-screen__content">
    <h2 class="admin-screen__heading">
        Admin
    </h2>
    <div class="admin-screen__search">
        <div class="admin-screen__search--row">
            <form class="admin-screen__search-form" action="/admin/search" method="get">
                @csrf
                <div class="search-form__item">
                    <!-- keyword -->
                    <input class="search-form__item-input--keyword" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">
                    <!-- 性別：セレクトボタンの▼未装飾装飾 -->
                    <select class="search-form__item-select" name="gender" >
                        <option value="" disabled selected {{request('gender') == 'null' ? 'selected' : '' }} >性別</option>
                        <!-- <option value="" disabled selected>性別</option> -->
                        <option value="all" {{request('gender') == 'all' ? 'selected' : '' }}>すべて</option>
                        <option value="1" {{request('gender') == '1' ? 'selected' : '' }}>男性</option>
                        <option value="2" {{request('gender') == '2' ? 'selected' : '' }}>女性</option>
                        <option value="3" {{request('gender') == '3' ? 'selected' : '' }}>その他</option>
                    </select>
                    <!-- お問い合わせの種類性別：セレクトボタンの▼未装飾装飾 -->
                    <select class="search-form__item-select" name="category_id" >
                        <option value="" selected >お問い合わせの種類</option>
                        @foreach($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                        @endforeach
                    </select>
                    <!-- 日付：カレンダーアイコンを▼に未変更 -->
                    <input class="search-form__item-input--date" type="date" name="date" value="{{ request('date') }}"></input>
                </div>
                <div class="search-form__button">
                    <button class="search-form__button--submit search-form__button--search" type ="submit">検索</button>
                </div>
                <div class="search-form__button">
                    <a class="search-form__button--submit search-form__button--reset"  href="/admin">リセット</a>
                </div>
            </form>
        </div>
        <!-- エクスポート用のフォーム:6/1未実装 -->
        <div class="admin-screen__search--row">
            <form class="search-form__export" action="/admin/export" method="post">
                @csrf
                <!-- 未記述：ボタンのレイアウトのみ行っておく -->
                <button type="submit">エクスポート</button>
            </form>
            <!-- レイアウトがBootstrapの標準の物、レイアウト変更必要 -->
            <div class="search-form__pagination">
                {{ $contacts->links()}}
            </div>
        </div>
    </div>
    <table class="admin-screen__data-table">
        <tr class="data-table__row--header">
            <th class="data-table__heading">
                お名前
            </th>
            <th class="data-table__heading">
                性別
            </th>
            <th class="data-table__heading">
                メールアドレス
            </th>
            <th class="data-table__heading">
                お問い合わせの種類
            </th>
            <th class="data-table__heading">
                <!-- 詳細の上部に当たる空白セル -->
            </th>
        </tr>
        @foreach ($contacts as $contact)
        <tr class="data-table__row--item">
            <td class="data-table__content">
                {{ $contact['last_name'] }}{{$contact['first_name']}}
            </td>
            <td class="data-table__content">
                <!-- $contactのgender部分からswitch文を使用し、該当する箇所に来たらbreakで処理が止まるようにすると該当の箇所に来たら文字列で表示される -->
                @switch($contact->gender)
                    @case(1)
                        男性
                        @break
                    @case(2)
                        女性
                        @break
                    @case(3)
                        その他
                        @break
                    @default
                        不明
                @endswitch
            </td>
            <td class="data-table__content">
                {{ $contact['email'] }}
            </td>
            <td class="data-table__content">
                {{ $contact['category_id'] ? $contact->category->content : 'なし' }}
            </td>
            <td class="data-table__content">
                <button wire:click="openModal()" type="button" class="modal-button">詳細</button>
                <!-- モーダルうまく機能しないので、メモで残す。再度後で挑戦
                ＠if($showModal)
                <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
                    <form role="form" class="form-inline" method="post" action="">
                        @csrf
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">お問い合わせ詳細</h5>
                                    <button wire:click="closeModal()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる">x</button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>お名前</strong><span id="modal-name"></span></p>
                                    <p><strong>性別</strong><span id="modal-gender"></span></p>
                                    <p><strong>メールアドレス</strong><span id="modal-email"></span></p>
                                    <p><strong>電話番号</strong><span id="modal-tel"></span></p>
                                    <p><strong>住所</strong><span id="modal-address"></span></p>
                                    <p><strong>建物名</strong><span id="modal-building"></span></p>
                                    <p><strong>お問い合わせの種類</strong><span id="category"></span></p>
                                    <p><strong>お問い合わせの内容</strong><span id="modal-detail"></span></p>
                                </div>
                                <div class="model-footer">
                                    <button type="button" class="btn btn-danger">削除</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                ＠endif -->
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection