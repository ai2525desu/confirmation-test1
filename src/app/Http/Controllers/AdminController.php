<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// ページネーション
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
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

    // 検索
    public function search(Request $request)
    {
        $contacts = Contact::with('category')->KeywordSearch($request->keyword)->GenderSearch($request->gender)->CategorySearch($request->category_id)->DateSearch($request->date)->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

        // ログアウトのためのアクション
        public function destroy(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            return redirect('auth.login');
        }
}

