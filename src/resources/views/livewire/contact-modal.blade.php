@if ($isOpen)
    <div class="modal-overlay">
        <div class="modal-content">
            <h2>お問い合わせ詳細</h2>

            @if ($contact)
                <p><strong>名前:</strong> {{ $contact->full_name }}</p>
                <p><strong>性別:</strong> {{ $contact->gender_text }}</p>
                <p><strong>メール:</strong> {{ $contact->email }}</p>
                <p><strong>住所:</strong> {{ $contact->address }}</p>
                <p><strong>建物名:</strong> {{ $contact->building }}</p>
                <p><strong>内容:</strong> {{ $contact->detail }}</p>
            @else
                <p>読み込み中...</p>
            @endif
            

            <button wire:click="closeModal">閉じる</button>
        </div>
    </div>
@endif
