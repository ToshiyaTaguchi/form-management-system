<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'last_name' => 'required',
            'first_name' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'tel1' => ['nullable', 'digits_between:1,5', 'regex:/^[0-9]+$/'],
            'tel2' => ['nullable', 'digits_between:1,5', 'regex:/^[0-9]+$/'],
            'tel3' => ['nullable', 'digits_between:1,5', 'regex:/^[0-9]+$/'],
            'address' => 'required',
            'category_id' => 'required',
            'message' => 'required|max:120',

        ];
    }
    
    public function messages(): array
    {
        return [
            'last_name.required' => '姓を入力してください',
            'first_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'tel1.required' => '電話番号を入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel3.required' => '電話番号を入力してください',
            'tel1.digits' => '電話番号の最初の項目は3桁の数字で入力してください',
            'tel2.digits' => '電話番号の中央の項目は4桁の数字で入力してください',
            'tel3.digits' => '電話番号の最後の項目は4桁の数字で入力してください',
            'tel1.numeric' => '電話番号は5桁までの数字で入力してください',
            'tel2.numeric' => '電話番号は5桁までの数字で入力してください',
            'tel3.numeric' => '電話番号は5桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'message.required' => 'お問い合わせ内容を入力してください',
            'message.max' => 'お問合せ内容は120文字以内で入力してください',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $tel1 = $this->input('tel1');
            $tel2 = $this->input('tel2');
            $tel3 = $this->input('tel3');

            // いずれかが未入力
            if (empty($tel1) || empty($tel2) || empty($tel3)) {
                $validator->errors()->add('tel', '電話番号を入力してください');
            }
        });
    }
}
