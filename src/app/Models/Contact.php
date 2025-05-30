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
}
