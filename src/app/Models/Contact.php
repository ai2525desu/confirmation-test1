<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // 書き換えOKの設定
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail'
    ];

    // ファクトリでのダミーデータ作成
    public function run()
    {
        Contact::factory()->conunt(35)->create();
    }

    // Categoryモデルとのリレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 検索機能
    // 名前とメールはkeywordにて検索
    public function scopeKeywordSearch($query, $keyword)
    {
        if(!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                    ->orwhere('last_name', 'like', "%{$keyword}%")
                    ->orwhere('email', 'like', "%{$keyword}%");
            });
        }
    }
    // 性別
    public function scopeGenderSearch($query, $gender)
    {
        if(!empty($gender)) {
            $query->where('gender', $gender);
        }
    }
    // 種類
    public function scopeCategorySearch($query, $category_id)
    {
        if(!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }

    // 日付
    public function scopeDateSearch($query, $date)
    {
        if(!empty($date)) {
            $query->whereData('created_at', $date);
        }
    }
}
