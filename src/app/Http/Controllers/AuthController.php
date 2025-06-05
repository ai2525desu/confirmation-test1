<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\Contact;
use App\Models\Category;

class AuthController extends Controller
{
    // ユーザー登録画面の表示
    public function register()
    {
        return view('auth.register');
    }

    // ユーザー登録でバリデーションをフォームリクエストで行うためにstoreアクション
    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return view('auth.login', compact('user'));
    }

    // ログイン画面の表示:get
    public function login()
    {
        return view('auth.login');
    }

    // ログインのためのアクション:post
    public function authenticate(LoginRequest $request)
    {
        $user = $request->only('email', 'password');

        if (Auth::attempt($user)) {
            $request->session()->regenerate();
            // intended('/admin')で指定したページにリダイレクトされる
            return redirect()->intended('/admin');
        } else {
            return back()->withErrors([
                'email' => 'ログイン情報が正しくありません',
            ]);
            // withEroors()メソッドでエラーメッセージの表示もできる。
        }
    }

}
