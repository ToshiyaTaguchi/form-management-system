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
}
