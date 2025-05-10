@extends('layouts.app')

@section('index')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

<>
    <header>
        <h1>FashionablyLate</h1>
        <form action="{{ route('logout') }}" method="POST" style="text-align:right;">
            @csrf
            <button type="submit" class="logout-button">logout</button>
        </form>
    </header>

    <>
        <h2>Admin</h2>

        <form method="GET" action="{{ route('admin.index') }}" class="search-form">
            <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください">
            <select name="gender">
                <option value="">性別</option>
                <option value="男性">男性</option>
                <option value="女性">女性</option>
            </select>
            <select name="category">
                <option value="">お問い合わせの種類</option>
                <!-- 動的に埋め込む場合は @foreach -->
            </select>
            <input type="date" name="date">

            <button type="submit" class="search-btn">検索</button>
            <a href="{{ route('admin.index') }}" class="reset-btn">リセット</a>
        </form>

        <button class="export-btn">エクスポート</button>

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
                @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->gender }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->name }}</td>
                    <td><a href="{{ route('admin.detail', $contact->id) }}" class="detail-btn">詳細</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $contacts->links() }}
        </div>
@endsection