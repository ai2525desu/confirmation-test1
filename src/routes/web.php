<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 入力フォーム
Route::get('/', [ContactController::class, 'index']);

// 確認画面
Route::post('/confirm', [ContactController::class, 'confirm']);

// サンクス画面の表示
Route::post('/thanks', [ContactController::class, 'thanks']);

//  ここからログイン認証に関連するルーティング
// 登録画面
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'store']);

// ログイン画面
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);

// 管理画面：ログイン後にしか表示されないように設定
// いったん画面上の確認したいのでミドルウェアを切っておく
// Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'admin']);
    Route::get('/admin/search', [AdminController::class, 'search']);
// });

// ログアウト
Route::post('/logout', [AdminController::class, 'destroy'])->name('logout');



