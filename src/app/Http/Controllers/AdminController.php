<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        // 名前またはメールアドレス(部分一致)でフィルタリング
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                    ->orWhere('last_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        // 性別(完全一致)
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }
        
        // カテゴリ(完全一致)
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        $contacts = $query->with('category')->orderBy('created_at', 'desc')->paginate(7);
        $contacts->appends($request->all());

        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    // モーダルウィンドウで詳細を表示
    public function detail($id)
    {
        $contact = Contact::with('category')->findOrFail($id);

        // モーダル用部分ビューを返す
        return view('admin.partials.detail', compact('contact'));
    }

    public function export(Request $request)
    {
        $query = Contact::query();

        // 名前またはメールのキーワード検索（部分一致）
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                    ->orWhere('last_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        // 性別（1:男性, 2:女性, 3:その他）
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // カテゴリIDでフィルタ
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // 日付でフィルタ（created_atのDATE部分のみで比較）
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->with('category')->get();

        // CSVファイル名
        // 現在の日付と時刻を取得
        // 例: content_20231001_123456.csv
        $filename = 'content_' . now()->format('Ymd_His') . '.csv';
        $encodedFilename = rawurlencode($filename);
        
        // ストリーミングレスポンスでCSV出力
        return response()->stream(function () use ($contacts) {
            $stream = fopen('php://output', 'w');

            // BOMを追加してExcelでの文字化けを防ぐ
            fwrite($stream, "\xEF\xBB\xBF");

            // ヘッダー行を追加
            fputcsv($stream, ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類']);

            foreach ($contacts as $contact) {
                fputcsv($stream, [
                    $contact->full_name,
                    $contact->gender_text,
                    $contact->email,
                    $contact->category->name ?? '未設定',
                ]);
                }

                fclose($stream);
        }, 200, [
                    'Content-Type' => 'text/csv; charset=UTF-8',
                    'Content-Disposition' => "attachment; filename=\"{$filename}\"; filename*=UTF-8''{$encodedFilename}",
                ]);
        }
}