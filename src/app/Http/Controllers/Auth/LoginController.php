<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * 로그인 폼 표시
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * 유저 로그인 처리
     */
    public function login(Request $request)
    {
        // 입력값 유효성 검사
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 유저 로그인 시도
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('posts.index')->with('success', '로그인 성공');
        }

        return back()->withErrors(['email' => '이메일 또는 비밀번호가 올바르지 않습니다.']);
    }

    /**
     * 유저 로그아웃 처리
     */
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('success', '로그아웃 완료');
    }
}
