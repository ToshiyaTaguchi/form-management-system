<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query()->with('category');

        // フィルター処理
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->orderBy('created_at', 'desc')->paginate(7);
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

    public function export()
    {
        // - Contact モデルを使って全レコードを取得 (get())
        // - with('category') を指定して、関連する category データも一緒に取得
        $contacts = Contact::with('category')->get();
        // CSVヘッダー
        $csvHeader = [
        'お名前', '性別', 'メールアドレス', 'お問い合わせの種類', '登録日時'
        ];

    //- $contacts の各レコードをマップ処理して、CSVフォーマットの配列を作成
        $csvData = $contacts->map(function ($contact) {
            return [
                $contact->name,
                $contact->gender,
                $contact->email,
                //　↓カテゴリが存在しない場合でもエラーを出さないように
                optional($contact->category)->name,
                // 日付フォーマットの調整
                $contact->created_at->format('Y-m-d H:i:s'),
            ];
        });
    
        // CSVデータ作成
        $callback = function () use ($csvHeader, $csvData) {
            // ダウンロード用のストリームを開く
            $file = fopen('php://output', 'w');
            // 文字化け対策(Windows環境)
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM
            // 最初の行にヘッダーを書き込む
            fputcsv($file, $csvHeader);
        
            // 各レコードをCSV形式で書き込む
            // $csvData は配列のコレクションなので、foreach でループ処理
            // 1行ずつ CSV に書き込む
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            // ファイルを閉じる
            fclose($file);
        };

        // ファイル名を生成　現在時刻を組み込んだファイル名を生成
        $filename = 'contacts_' . now()->format('Ymd_His') . '.csv';

        // ダウンロード用のレスポンスを生成
        return response()->streamDownload($callback, $filename, [
            // CSVファイルとして認識
            'Content-Type' => 'text/csv',
            // 指定した名前でダウンロードできるよう設定
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }
}