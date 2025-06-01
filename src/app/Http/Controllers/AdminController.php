<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// ページネーション
use Illuminate\Pagination\Paginator;
use App\Models\Contact;
use App\Models\Category;


class AdminController extends Controller
{
    // 管理画面のレイアウト確認
    public function admin()
    {
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));
    }
}

