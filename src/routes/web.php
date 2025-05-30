<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
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

//  ここから管理に関連するルーティング
// 登録画面
Route::get('/register', [AuthController::class, 'register']);

// ログイン画面
Route::get('/login', [AuthController::class, 'login']);
