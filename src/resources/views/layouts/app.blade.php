<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inika&display=swap" rel="stylesheet">

    @livewireStyles {{-- Livewireのスタイル --}}
    @yield('styles') {{-- 必要があればページ個別スタイル --}}
    
</head>
<body>
    <header class="site-header">
        <div class="container">
            <h1 class="site-title">FashionablyLate</h1>
        </div>

        {{-- layouts/app.blade.php の中のヘッダーなどに追加 --}}
        @if (Request::is('admin*'))
            <form method="POST" action="{{ route('logout') }}" style="text-align:right;">
                @csrf
                <button type="submit" class="logout-button">logout</button>
            </form>
        @endif
    </header>

    <main class="site-main">
        @yield('content')
    </main>

    @livewireScripts {{-- LivewireのJavaScript --}}
    @stack('scripts')

</body>
</html>

