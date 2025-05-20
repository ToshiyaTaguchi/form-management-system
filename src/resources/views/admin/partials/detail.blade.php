<div>
    <h3>{{ $contact->full_name }}</h3>
    <p>性別: {{ $contact->gender_text }}</p>
    <p>メール: {{ $contact->email }}</p>
    <p>電話番号: {{ $contact->tel }}</p>
    <p>住所: {{ $contact->address }}</p>
    <p>建物名: {{ $contact->building }}</p>
    <p>お問い合わせの種類: {{ $contact->category->name }}</p>
    <p>お問い合わせ内容: {{ $contact->detail }}</p>
</div>