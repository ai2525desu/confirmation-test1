<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    // お問い合わせ入力フォームのアクション
    public function index()
    {
        // Contactモデルのインスタンス
        // $contact = new Contact();
        // // ここで、インスタンスで取得したものをデータに整える
        // $contacts = $contact->all();
        $contacts = Contact::all();
        $categories = Category::all();
        return view('index', compact('contacts', 'categories'));
        // return view('index', compact('categories'));
    }

    // 確認画面のアクション
    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category_id', 'detail']);
        $category = Category::find($contact['category_id']);
        $contact['category_content'] = $category ? $category->content : 'なし';
        // 確認画面のコントローラー内に修正を行う際のデータの送信記述をしていたが、このアクションはthanks画面に遷移する際に必要なアクションだった。
        // if($request->input('back') == 'back') {
        //     return redirect()->route('index')->withInput();
        // }

        return view('confirm', compact('contact', 'category'));
    }

    // 自分で考えたサンクスページのアクション：
    // public function thanks(Request $request)
    // {
    //     $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel1','tel2', 'tel3',  'address', 'building', 'category_content','category_id', 'detail']);
    //     return view('thanks', compact('contact'));
    // }

    // 解答例：送信ボタンでの挙動と修正ボタンでの挙動の内容を条件分岐
    public function thanks(ContactRequest $request)
    {
        if ($request->has('back')) {
            return redirect('/')->withInput();
        }
        // $request['tel'] = $request->tel1 . $request->tel2 . $request->tel3;
        // telをマージしてみる
        $request->merge([
            'tel' => $request->tel1 . $request->tel2 . $request->tel3
        ]);
        Contact::create(
            $request->only([
                'category_id',
                'first_name',
                'last_name',
                'gender',
                'email',
                'tel',
                'address',
                'building',
                'detail'
            ])
        );
        return view('thanks');
    }
}
