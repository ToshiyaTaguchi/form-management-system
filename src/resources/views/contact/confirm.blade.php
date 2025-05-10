@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">

<div class="contact-form__content">
    <div class="contact-form__heading">
        <h1 class="contact-title">Confirm</h1>
    </div>

    <form  action="{{ route('contact.store') }}" method="POST">
        @csrf

        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        {{ $inputs['first_name'] }} {{ $inputs['last_name'] }} {{-- 表示用 --}}
                        <input type="hidden" name="first_name" value="{{ $inputs['first_name'] }}" >
                        <input type="hidden" name="last_name" value="{{ $inputs['last_name'] }}" >

                    </td>
                </tr>

                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        {{ $inputs['gender'] == 1 ? '男性' : '女性' }} {{-- 表示用 --}}
                        <input type="hidden" name="gender" value="{{ $inputs['gender'] }}">
                    </td>
                </tr>

                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        {{ $inputs['email'] }} {{-- 表示用 --}}
                        <input type="hidden" name="email" value="{{ $inputs['email'] }}">
                    </td>
                </tr>

                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        {{-- 電話番号の各部分を結合して表示 --}}
                        {{ $inputs['tel1'] }}-{{ $inputs['tel2'] }}-{{ $inputs['tel3'] }} {{-- 表示用 --}}
                        <input type="hidden" name="tel1" value="{{ $inputs['tel1'] }}">
                        <input type="hidden" name="tel2" value="{{ $inputs['tel2'] }}">
                        <input type="hidden" name="tel3" value="{{ $inputs['tel3'] }}">
                    </td>
                </tr>

                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        {{-- 住所の各部分を結合して表示 --}}
                        {{ $inputs['address'] }} {{-- 表示用 --}}
                        <input type="hidden" name="address" value="{{ $inputs['address'] }}">
                    </td>
                </tr>

                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                        <td class="confirm-table__text">
                        {{-- 建物名の各部分を結合して表示 --}}
                        {{ $inputs['building'] }} {{-- 表示用 --}}
                        <input type="hidden" name="building" value="{{ $inputs['building'] }}">
                        </td>
                </tr>

                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        {{-- お問い合わせの種類の各部分を結合して表示 --}}
                        {{ $inputs['category'] }} {{-- 表示用 --}}
                        <input type="hidden" name="category_id" value="{{ $inputs['category_id'] }}">
                    </td>
                </tr>

                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        {{-- お問い合わせ内容の各部分を結合して表示 --}}
                        {{ $inputs['message'] }} {{-- 表示用 --}}
                        <input type="hidden" name="message" value="{{ $inputs['message'] }}">
                    </td>
                </tr>
            </table>
        </div>
        {{-- ボタン（送信 + 修正） --}}
        <div class="form__buttons">
            <button type="submit" name="action" value="submit">送信</button>
            <button type="submit" name="action" value="back">修正</button>
        </div>
            
    </form>
</div>
@endsection