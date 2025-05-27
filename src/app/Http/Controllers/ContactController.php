<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // お問い合わせ入力フォームのアクション
    public function index()
    {
        return view('index');
    }

    // 確認画面のアクション
    public function confirm(Request $request)
    {
        // リレーションしてcategory_id反映させないといけない。categoryの部分エラーが出ると思う
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel1','tel2', 'tel3','address', 'building', 'category', 'content']);
        return view('confirm', compact('contact'));
    }

    // サンクスページのアクション
    public function thanks()
    {
        return view('thanks');
    }
}
