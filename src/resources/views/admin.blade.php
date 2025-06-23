@extends('layouts.admin-layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/pagination.css') }}" />
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
<script>
    // モーダルを開く際のonclickの挙動
    function openModal(id) {
        document.getElementById('detailModal' + id).style.display = 'block';
    }

    // モーダルを閉じる際のonclickの挙動
    function closeModal(id) {
        document.getElementById('detailModal' + id).style.display = 'none';
    }

    // モーダル内の削除ボタンで、データを削除する際の挙動
    // deleteContact(id)で削除したいお問い合わせデータのidを受け取る
    function deleteContact(id) {
        // confirmアクションを使用して削除してよいか確認
        if (confirm('削除しますか？')) {
            // fetch()でページ更新をせず、同じページ内で削除の挙動が行えるように設定
            // サーバーに HTTP DELETE リクエストを送信します。URLは /admin/delete/{id} に動的に組み立て
            fetch(`/admin/delete/${id}`, {
                //HTTPのmethodでdeleteを指定
                method: 'DELETE',
                // csrf対策で、トークンを'X-CSRF-TOKEN'というヘッダーに含めている
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
                // .then(response => response.json())：サーバーから返ってきたレスポンスを JSON 形式でパース
                // 返ってきた JSON データの中で、success プロパティが true かどうかをチェック
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    // 削除対象のモーダルを非表示にする設定
                    document.getElementById('detailModal' + id).style.display = 'none';
                    // 削除が成功したときのアラート
                    alert('削除しました');
                } else {
                    // 削除に失敗したときのアラート
                    alert('削除に失敗しました');
                }
            });
        }
    }
</script>
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
                    <select class="search-form__item-select" name="gender">
                        <option value="" disabled selected {{request('gender') == 'null' ? 'selected' : '' }}>性別</option>
                        <!-- <option value="" disabled selected>性別</option> -->
                        <option value="all" {{request('gender') == 'all' ? 'selected' : '' }}>すべて</option>
                        <option value="1" {{request('gender') == '1' ? 'selected' : '' }}>男性</option>
                        <option value="2" {{request('gender') == '2' ? 'selected' : '' }}>女性</option>
                        <option value="3" {{request('gender') == '3' ? 'selected' : '' }}>その他</option>
                    </select>
                    <!-- お問い合わせの種類性別：セレクトボタンの▼未装飾装飾 -->
                    <select class="search-form__item-select" name="category_id">
                        <option value="" selected>お問い合わせの種類</option>
                        @foreach($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                        @endforeach
                    </select>
                    <!-- 日付：カレンダーアイコンを▼に未変更 -->
                    <input class="search-form__item-input--date" type="date" name="date" value="{{ request('date') }}"></input>
                </div>
                <div class="search-form__button">
                    <button class="search-form__button--submit search-form__button--search" type="submit">検索</button>
                </div>
                <div class="search-form__button">
                    <a class="search-form__button--submit search-form__button--reset" href="/admin">リセット</a>
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
                <!-- {{ $contact['category_id'] ? $contact->category->content : 'なし' }} -->
                {{ optional($contact->category)->content ?? 'なし' }}
            </td>
            <td class="data-table__content">
                <!-- onclick="openModal({{ $contact['id'] }})"でforeachによって配列の繰り返しをしてるので、$contact['id']を引数で関数に渡し、開きたいモーダルの内容を取得してくれるようにする -->
                <button onclick="openModal({{ $contact['id'] }})" type="button" class="modal-button">詳細</button>
                <!-- 
                ・id="detailModal{{ $contact['id'] }}"は、モーダル自体にidを設け、それが上記のopenModalと同じものだとわかるようにしている
                ・style="display: none;z-index: 1000;によって、HTML上にcssのスタイルを記述。初期状態ではモーダルが非表示で、表示された際には最前面に表示されるように配置の順序を指定している。これは、JavaScriptの記述とセットで使用されることが多い。
                -->
                <div class="modal" id="detailModal{{ $contact['id'] }}" style="display: none;z-index: 1000;">
                    <form role="form" class="form-inline" method="post" action="">
                        @csrf
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">お問い合わせ詳細</h5>
                                    <button onclick="closeModal({{ $contact['id'] }})" type="button" class="btn-close" aria-label="閉じる"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- それぞれspanタグ内にお問い合わせの内容が該当する箇所を表示されるようにする -->
                                    <p><strong>お名前</strong><span id="modal-name">{{ $contact['last_name'] }}&nbsp;{{ $contact['first_name'] }}</span></p>
                                    <p>
                                        <strong>性別</strong>
                                        <span id="modal-gender">
                                            <!-- 性別は数値で取得しているため、swich文を使用して該当する性別が表示されるようにする。if文でも記述できるとのこと -->
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
                                        </span>
                                    </p>
                                    <p><strong>メールアドレス</strong><span id="modal-email">{{ $contact['email'] }}</span></p>
                                    <p><strong>電話番号</strong><span id="modal-tel">{{ $contact['tel'] }}</span></p>
                                    <p><strong>住所</strong><span id="modal-address">{{ $contact['address'] }}</span></p>
                                    <p><strong>建物名</strong><span id="modal-building">{{ $contact['building'] }}</span></p>
                                    <p>
                                        <strong>お問い合わせの種類</strong>
                                        <!-- コントローラーで、Category:::all（）で取得している箇所からデータを持ってくる必要があるため、連想配列で$categoriesからキーと値の取得をしている -->
                                        <span id="category">{{ optional($contact->category)->content ?? 'なし' }}</span>
                                    </p>
                                    <p><strong>お問い合わせの内容</strong><span id="modal-detail">{{ $contact['detail'] }}</span></p>
                                </div>
                                <div class="model-footer">
                                    <!-- JavaScriptにおいてdeleteContactの関数を設定し、$contactのidを取得して -->
                                    <button type="button" onclick="deleteContact({{ $contact['id'] }})" class="btn btn-danger">削除</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection