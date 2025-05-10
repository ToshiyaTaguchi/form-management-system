<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <header>
        <h1>FashionablyLate</h1>
        <button class="logout">ログアウト</button>
    </header>
    <main>
        <h2>管理画面</h2>
        <div class="search-filters">
            <input type="text" placeholder="名前やメールアドレスを入力してください">
            <select>
                <option value="">性別</option>
            </select>
            <select>
                <option value="">お問い合わせの種類</option>
            </select>
            <select>
                <option value="">年/月/日</option>
            </select>
            <button class="search">検索</button>
            <button class="reset">リセット</button>
        </div>
        <button class="export">エクスポート</button>
        <table>
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>山田 太郎</td>
                    <td>男性</td>
                    <td>test@example.com</td>
                    <td>商品の交換について</td>
                    <td><button class="details">詳細</button></td>
                </tr>
                <!-- 他の行も追加可能 -->
            </tbody>
        </table>
        <div class="pagination">
            <button>1</button>
            <button>2</button>
            <button>3</button>
            <button>4</button>
            <button>5</button>
        </div>
    </main>
</body>
</html>