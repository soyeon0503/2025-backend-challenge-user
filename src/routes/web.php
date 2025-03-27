<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UserLikeProductController;
use App\Http\Controllers\UserSavedProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;

// 메인 페이지: 로그인 여부에 따라 리디렉트
Route::get('/', function () {
    return redirect()->route(Auth::guard('web')->check() ? 'users.index' : 'login');
})->middleware('web');

// [유저 로그인 관련 라우트]
Route::prefix('user')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [LoginController::class, 'register']);
});

// [관리자 로그인 관련 라우트]
Route::get('/manager/login', [ManagerController::class, 'showLoginForm'])->name('manager.login');
Route::post('/manager/login', [ManagerController::class, 'login']);
Route::post('/manager/logout', [ManagerController::class, 'logout'])->name('manager.logout');

// [일반 유저 전용 라우트]
Route::middleware(['auth:web'])->group(function () {
    Route::resource('users', UserController::class)->except('index');
    Route::post('/likes/{product}/toggle', [UserLikeProductController::class, 'toggle'])->name('likes.toggle');

    Route::post('/saves/{product}/toggle', [UserSavedProductController::class, 'toggle'])->name('saves.toggle');
});

// [회사 관리자 전용 라우트]
Route::middleware(['auth:manager'])->group(function () {
    Route::get('/manager/profile', [ManagerController::class, 'edit'])->name('manager.profile.edit');
    Route::post('/manager/profile', [ManagerController::class, 'update'])->name('manager.profile.update');
    Route::delete('/manager/delete', [ManagerController::class, 'delete'])->name('manager.delete');
    Route::get('companies/{company}/managers/create', [CompanyController::class, 'create'])->name('managers.create');
    Route::post('companies/{company}/managers', [CompanyController::class, 'store'])->name('managers.store');
    Route::get('/companies/liked-users', [CompanyController::class, 'likedUsers'])->name('companies.likedUsers');
    Route::get('/companies/saved-users', [CompanyController::class, 'savedUsers'])->name('companies.savedUsers');
    Route::resource('companies', CompanyController::class);
    Route::resource('products', ProductController::class);
    Route::resource('managers', ManagerController::class);
    Route::resource('users', UserController::class)->except('create', 'store','show','destroy');
    Route::resource('posts', PostController::class);
});

// [게시물 관련 라우트 (유저, 관리자 공통)]
Route::resource('posts', PostController::class)->only(['index', 'show']);

// [Google 로그인]
Route::get('/auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

// [Kakao 로그인]
Route::get('/auth/kakao', [LoginController::class, 'redirectToKakao']);
Route::get('/auth/kakao/callback', [LoginController::class, 'handleKakaoCallback']);

// [비밀번호 찾기 관련 라우트]
Route::prefix('password')->group(function () {
    Route::get('/reset', [PasswordController::class, 'showResetForm'])->name('password.request');
    Route::post('/reset', [PasswordController::class, 'sendVerificationCode'])->name('password.email');
    Route::get('/verify', [PasswordController::class, 'showVerifyForm'])->name('password.verify');
    Route::post('/verify', [PasswordController::class, 'verifyCode'])->name('password.verify.post');
    Route::get('/change', [PasswordController::class, 'showChangePasswordForm'])->name('password.change.form');
    Route::post('/change', [PasswordController::class, 'changePassword'])->name('password.change');
});
