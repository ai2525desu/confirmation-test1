<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// ページネーション
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Log;


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
        $contacts = Contact::with('category')->KeywordSearch($request->keyword)->GenderSearch($request->gender)->CategorySearch($request->category_id)->DateSearch($request->date)->paginate(7)->appends($request->query());
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    // ログアウトのためのアクション
    public function destroy(Request $request)
    {
        Log::debug('test');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // return redirect('auth.login');
        return redirect('/login');
    }

    // モーダルの削除機能
    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        // ここで、削除が成功したときの挙動がtrueになるようにreturnを返さないとエラーがブラウザ上で発生する
        return ['success' => true];
    }

    // エクスポート
    public function export(Request $request)
    {
        $contacts = Contact::with('category')->KeywordSearch($request->keyword)->GenderSearch($request->gender)->CategorySearch($request->category_id)->DateSearch($request->date)->get();

        $csv = fopen('php://temp', 'w');
        fputcsv($csv, ['ID', 'お名前', '性別', 'メールアドレス', 'お問い合わせの種類', 'お問い合わせの内容', '作成日時']);
        foreach ($contacts as $contact) {
            fputcsv($csv, [$contact->id, $contact->name, $contact->gender, $contact->email, $contact->category->content, $contact->content, $contact->created_at]);
        }
        fseek($csv, 0);
        return response()->streamDownload(function () use ($csv) {
            fpassthru($csv);
            fclose($csv);
        }, 'test.csv');
    }
}
