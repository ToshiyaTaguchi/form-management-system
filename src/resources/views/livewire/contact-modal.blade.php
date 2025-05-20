<div>
    <!-- モーダルを開くボタン（外部ループから呼び出す想定） -->
    <!-- これは別のファイル側で繰り返す -->
    {{-- <button wire:click="open({{ $contact->id }})">詳細</button> --}}

    <!-- モーダル表示 -->
    @if ($isOpen && $contact)
        <div class="modal-overlay">
            <div class="modal-content">
                <h2>お問い合わせ詳細</h2>
                <p><strong>名前:</strong> {{ $contact->full_name }} {{ $contact->last_name }}</p>
                <p><strong>性別:</strong> {{ $contact->gender_text }}</p>
                <p><strong>メール:</strong> {{ $contact->email }}</p>
                <p><strong>住所:</strong> {{ $contact->address }}</p>
                <p><strong>建物名:</strong> {{ $contact->building }}</p>
                <p><strong>内容:</strong> {{ $contact->detail }}</p>
                <button wire:click="closeModal">閉じる</button>
            </div>
        </div>
    @endif
</div>
