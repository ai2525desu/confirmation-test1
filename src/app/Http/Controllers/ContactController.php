<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    // お問い合わせ入力フォームのアクション
    // public function index()
    // {
    //     $contact = new Contact();
    //     $categories = Category::all();
    //     return view('index', compact('contact','categories'));
    // }
    // 修正で
    public function index(Request $request)
    {
        $contact = new Contact($request->all());
        $categories = Category::all();
        return view('index', compact('contact','categories'));
    }
    // 確認画面のアクション
    // エラーで値の送信ができていない。ダミーデータはOK。電話番号が三分割にしてあることが問題か？
    public function confirm(ContactRequest $request)
    {
        // Contactモデルのcateogryメソッド取得
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category_id', 'detail']);
        $category = Category::find($contact['category_id']);
        $contact['category_content'] = $category ? $category->content : 'なし';
        return view('confirm', compact('contact'));
    }


    // サンクスページのアクション
    public function thanks(Request $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel1','tel2', 'tel3',  'address', 'building', 'category_content','category_id', 'detail']);
        return view('thanks', compact('contact'));
    }

}
