@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
    <livewire:contact-modal />

        <div>
            <h2>Admin</h2>

            <form method="GET" action="{{ route('admin.index') }}" class="search-form">
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">
                <select name="gender">
                    <option value="">性別</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                </select>

                <select name="category">
                    <option value="">お問い合わせの種類</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <input type="date" name="date" value="{{ request('date') }}" >

                <button type="submit" class="search-btn">検索</button>
                <a href="{{ route('admin.index') }}" class="reset-btn">リセット</a>
            </form>

            <form method="GET" action="{{ route('admin.export') }}" >
                <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                <input type="hidden" name="gender" value="{{ request('gender') }}">
                <input type="hidden" name="category" value="{{ request('category') }}">
                <input type="hidden" name="date" value="{{ request('date') }}">
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
                            <td>{{ $contact->category->name ?? '' }}</td>
                            <td><button class="detail-btn" data-id="{{ $contact->id }}">詳細</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $contacts->links() }}
            </div>
        </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        document.querySelectorAll('.detail-btn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                console.log('Emit openModal:', id); // デバッグ確認
                Livewire.emit('openModal', id);
            });
        });
    });
</script>
@endpush
