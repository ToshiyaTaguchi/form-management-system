<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - Register</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    
</head>
<body>
    <div class="container">
        <header>
            <h1>FashionablyLate</h1>
            <a href="#" class="login">login</a>
        </header>
        <main>
            <h2>Register</h2>
            <form cla0ss="form" action="{{ route('register') }}" method="POST">
                @csrf
                <label for="name">お名前</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="例: 山田太郎">
                @error('name') 
                    <div>{{ $message }}</div>
                @enderror
                
                <label for="email">メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                @error('email') 
                    <div>{{ $message }}</div>
                @enderror               
                
                <label for="password">パスワード</label>
                <input type="password" name="password" />
                <input type="password" name="password_confirmation" />
                @error('password') 
                    <div>{{ $message }}</div>
                @enderror
                
                <button type="submit">登録</button>
            </form>
            <div class="register-link">
                <p>すでにアカウントをお持ちですか？</p>
                <a href="{{ route('login') }}">ログイン</a>
            </div>
        </main>
    </div>
</body>
</html>

