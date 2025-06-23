<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;

    // 書き換えOKの設定
    protected $fillable = [
        'category_id',
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
        Contact::factory()->count(35)->create();
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
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where(DB::raw('CONCAT(last_name, first_name)'), 'like', "%{$keyword}%")
                    ->orwhere('first_name', 'like', "%{$keyword}%")
                    ->orwhere('last_name', 'like', "%{$keyword}%")
                    ->orwhere('email', 'like', "%{$keyword}%");
            });
        }
        return $query;
    }
    // 性別
    public function scopeGenderSearch($query, $gender)
    {
        if (!empty($gender) && $gender !== 'all') {
            return $query->where('gender', $gender);
        }
        return $query;
    }
    // 種類
    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
        return $query;
    }

    // 日付
    public function scopeDateSearch($query, $date)
    {
        if (!empty($date)) {
            $query->whereDate('created_at', $date);
        }
        return $query;
    }
}
