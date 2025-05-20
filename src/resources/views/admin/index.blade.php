@extends('layouts.app')

@section('content')
    @livewire('contact-modal')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">


    <div>
        <h2>Admin</h2>

        <form method="GET" action="{{ route('admin.index') }}" class="search-form">
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">
            <select name="gender">
                <option value="">性別</option>
                <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
                <option value="女性" {{ request('gender') == '女性' ? 'selected' : '' }}>女性</option>
            </select>

            <select name="category">
                <option value="">お問い合わせの種類</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <input type="date" name="date">

            <button type="submit" class="search-btn">検索</button>
            <a href="{{ route('admin.index') }}" class="reset-btn">リセット</a>
        </form>

        <form method="GET" action="{{ route('admin.export') }}" >
            <button type="submit" class="export-btn">エクスポート</button>
        </form>

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
                    <td>{{ $contact->full_name }}</td>
                    <td>{{ $contact->gender_text }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->name }}</td>
                    <td><button wire:click="$emit('openModal', {{ $contact->id }})" class="btn btn-primary">詳細</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $contacts->links() }}
        </div>
    </div>
@endsection
