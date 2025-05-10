<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    @yield('styles') {{-- 必要があればページ個別スタイル --}}
</head>
<body>
    <header class="site-header">
        <div class="container">
            <h1 class="site-title">FashionablyLate</h1>
        </div>
    </header>

    <main class="site-main">
        @yield('content')
    </main>


</body>
</html>
