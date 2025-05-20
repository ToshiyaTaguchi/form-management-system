<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'first_name', 'last_name', 'gender',
        'email', 'tel', 'address', 'building', 'detail'
    ];

    // categories テーブルとのリレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //フルネームのアクセサ
    public function getFullNameAttribute()
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    //　性別のアクセサ
    // Bladdeでの表記　<td>{{ $contact->gender_text }}</td>

    public function getGenderTextAttribute()
    {
        switch ($this->gender) {
            case 1:
                return '男性';
            case 2:
                return '女性';
            case 3:
                return 'その他';
            default:
                return '未設定';
        }
    }

}