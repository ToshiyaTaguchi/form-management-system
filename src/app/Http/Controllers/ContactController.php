<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('contact.index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $inputs = $request->all();

    // カテゴリIDに対応するカテゴリ名を取得
    $category = Category::find($inputs['category_id']);
    $inputs['category'] = $category ? $category->name : '未選択';

    return view('contact.confirm', compact('inputs'));

    $inputs['category'] = $category ? $category->name : '未選択';
    $inputs['category_id'] = $inputs['category_id']; // 念のため明示

    }
    

    public function store(Request $request)
    {
        $inputs = $request->all();

        // 電話番号を結合
        $tel = $inputs['tel1'] . '-' . $inputs['tel2'] . '-' . $inputs['tel3'];

         // 性別を数値に変換
        $genderMap = [
            '男性' => 1,
            '女性' => 2,
            'その他' => 3,
        ];
        $gender = $genderMap[$inputs['gender']] ?? 3;

        // 「修正」ボタンが押された場合
        if ($request->input('action') === 'back') {
            return redirect()->route('contact.index')->withInput(); // 入力値をフラッシュしてリダイレクト
        }

        // 登録処理
        Contact::create([
            'first_name' => $inputs['first_name'],
            'last_name' => $inputs['last_name'],
            'gender' => $gender,
            'email' => $inputs['email'],
            'tel' => $tel,
            'address' => $inputs['address'],
            'building' => $inputs['building'] ?? null,
            'detail' => $inputs['message'],
            'category_id' => $inputs['category_id'],
        ]);
        return redirect()->route('contact.thanks');
    }


    public function thanks()
    {
        return view('contact.thanks');
    }
}
