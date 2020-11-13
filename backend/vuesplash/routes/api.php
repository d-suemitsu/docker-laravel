<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// 会員登録
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register')->name('register');

// ログイン
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');

// ログアウト
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// ログインユーザー
Route::get('/user', fn() => Auth::user())->name('user');

// 写真投稿
Route::post('/photos', 'App\Http\Controllers\PhotoController@create')->name('photo.create');
