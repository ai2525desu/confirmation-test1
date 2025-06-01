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
                    <input class="search-form__item-input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください">
                    <!-- 性別 -->
                    <select class="search-form__item-select" name="gender" >
                        <option value="" {{request('gender') == 'null' ? 'selected' : '' }}>性別</option>
                        <option value="" {{request('gender') == 'all' ? 'selected' : '' }}>すべて</option>
                        <option value="1" {{request('gender') == '1' ? 'selected' : '' }}>男性</option>
                        <option value="2" {{request('gender') == '2' ? 'selected' : '' }}>女性</option>
                        <option value="3" {{request('gender') == '3' ? 'selected' : '' }}>その他</option>
                    </select>
                    <!-- お問い合わせの種類 -->
                    <select class="search-form__item-select" name="gender" >
                        <option value="" selected >お問い合わせの種類</option>
                        @foreach($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                        @endforeach
                    </select>
                    <!-- 日付 -->
                    <input class="search-form__item-input" type="date"></input>
                    <button class="search-form__button--search" type ="submit">検索</button>
                    <button class="search-form__button--reset" type ="submit">リセット</button>
                </div>
            </form>
        </div>
        <!-- エクスポート用のフォーム:6/1未実装 -->
        <div class="admin-screen__search--row">
            <form class="search-form__export" action="/admin/export" method="post">
                @csrf
                <button type="submit">エクスポート</button>
            </form>
            <div class="search-form__pagination">
                {{ $contacts->links()}}
            </div>
        </div>
        <div class="admin-screen__search--row">
            <table class="admin-screen__data-table">
                <tr class="data-table__row">
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
                <tr class="data-table__row">
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
                        <button>詳細</button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection