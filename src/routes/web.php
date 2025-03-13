<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\PasswordController;

// 인증 관련 라우트
Auth::routes([
    'reset' => false,   // 비밀번호 재설정 라우트 비활성화
    'verify' => false,  // 이메일 인증 라우트 비활성화
    'confirm' => false, // 비밀번호 확인 라우트 비활성화
]);

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

// 비밀번호 찾기 관련 라우트 (비회원도 접근 가능)
Route::prefix('password')->group(function () {
    Route::get('/reset', [PasswordController::class, 'showResetForm'])->name('password.request');
    Route::post('/reset', [PasswordController::class, 'sendVerificationCode'])->name('password.email');
    Route::get('/verify', [PasswordController::class, 'showVerifyForm'])->name('password.verify');
    Route::post('/verify', [PasswordController::class, 'verifyCode'])->name('password.verify.post');
    Route::get('/change', [PasswordController::class, 'showChangePasswordForm'])->name('password.change.form');
    Route::post('/change', [PasswordController::class, 'changePassword'])->name('password.change');
});
