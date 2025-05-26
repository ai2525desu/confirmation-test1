<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
            FashionablyLate
            </a>
        </div>
        <!-- 20250526_0039管理画面などのloginボタンの装飾できないかと思って付け足してみたが、これだとすべての画面にでちゃう？？cssの設定すると画面上に出てきてしまうのでうまくいかず、いったんコメントアウトして保留
        <div class="header__button">
            @yield('button')
        </div> -->
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>