<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

// 인증 관련 라우트
Auth::routes();

// 로그인 상태에 따라 홈 또는 로그인 페이지로 리다이렉트
Route::get('/', function () {
    return redirect()->route(Auth::check() ? 'users.index' : 'login');
})->middleware('web');

// 로그인한 사용자만 접근 가능한 라우트
Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
});

// Google
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Kakao
Route::get('/auth/kakao', [AuthController::class, 'redirectToKakao']);
Route::get('/auth/kakao/callback', [AuthController::class, 'handleKakaoCallback']);
