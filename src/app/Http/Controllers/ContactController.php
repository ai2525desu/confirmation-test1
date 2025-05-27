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
    public function confirm()
    {
        return view('confirm');
    }
}
