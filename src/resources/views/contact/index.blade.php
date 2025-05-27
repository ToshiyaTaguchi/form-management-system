@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
    <div class="contact-form__heading">
        <h1 class="contact-title">Contact</h1>
    </div>
    <form class="form" action="{{ route('contact.confirm') }}" method="POST">
        {{-- CSRFトークン --}}
    @csrf
        {{-- お名前 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">*</span>
            </div>
            <div class="form__group-content">
                <div class="name-fields">
                    <div class="form__flex-item">
                        <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例：山田">
                        @error('first_name') 
                            <div class="form__error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form__flex-item">
                        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例：太郎">
                        @error('last_name') 
                            <div class="form__error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- 性別 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">*</span>
            </div>
            <div class="form__group-content">
                <div class="radio-group">
                    <div class="form__flex-item">
                        <label><input type="radio" name="gender" value="男性" {{ old('gender' , '男性') == '男性' ? 'checked' : '' }}> 男性</label>
                        <label><input type="radio" name="gender" value="女性" {{ old('gender') == '女性' ? 'checked' : '' }}> 女性</label>
                        <label><input type="radio" name="gender" value="その他" {{ old('gender') == 'その他' ? 'checked' : '' }}> その他</label>
                        @error('gender') 
                            <div class="form__error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- メールアドレス --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">*</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="例：test@example.com">
                    @error('email') 
                        <div class="form__error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- 電話番号 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">*</span>
            </div> 
            <div class="form__group-content">
                <div class="tel-group">
                    <input type="text" name="tel1" value="{{ old('tel1') }}" placeholder="080">
                    <span> - </span>
                    <input type="text" name="tel2" value="{{ old('tel2') }}" placeholder="1234">
                    <span> - </span>
                    <input type="text" name="tel3" value="{{ old('tel3') }}" placeholder="5678">
                </div>
                {{-- まとめて表示 --}}
                @if ($errors->has('tel'))
                    <div class="form__error">{{ $errors->first('tel') }}</div>
                @elseif ($errors->hasAny(['tel1', 'tel2', 'tel3']))
                    <div class="form__error">電話番号は半角数字で、それぞれ5桁以内で入力してください。</div>
                @endif
            </div>
        </div>

        {{-- 住所 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">*</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" value="{{ old('address') }}" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3">
                    @error('address') 
                        <div class="form__error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- 建物名 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" value="{{ old('building') }}" placeholder="例：千駄ヶ谷マンション101">
                </div>
            </div>
        </div>

        {{-- お問い合わせの種類 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">*</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--option">

                    <select name="category_id">
                        <option value="">選択してください</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach

                            
                    </select>
                </div>
                <div class="form__error">
                    @error('category_id') 
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        
        {{-- お問い合わせ内容 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">*</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="message" rows="5" placeholder="お問い合わせ内容をご記載ください">{{ old('message') }}</textarea>
                    @error('message') 
                        <div class="form__error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- 確認ボタン --}}
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection
