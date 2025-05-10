<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - Login</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <header>
            <h1>FashionablyLate</h1>
            <button class="register">register</button>
        </header>
        <main>
            <h2>Login</h2>
            <form class="form" action="{{ route('login') }}" method="POST">
                @csrf
                <label for="email">メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                
                <label for="password">パスワード</label>
                <input type="password" name="password" />
                
                <button type="submit">ログイン</button>
            </form>
        </main>
    </div>
</body>
</html>
