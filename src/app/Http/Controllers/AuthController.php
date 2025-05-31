<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;

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
            'password' => $request->password
        ]);
        return view('/login', compact('user'));
    }

    // ログイン画面の表示:get
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $user = $request->only('email', 'password');

        if (Auth::attempt($user)) {
            $request->session()->regenerate;
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
