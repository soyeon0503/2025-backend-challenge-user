<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    // ----------------------
    // Google 로그인
    // ----------------------
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $socialUser = Socialite::driver('google')->stateless()->user();
            return $this->handleSocialLogin($socialUser, 'google');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Google 로그인 중 오류가 발생했습니다.');
        }
    }

    // ----------------------
    // Kakao 로그인
    // ----------------------
    protected function getTokenUrl()
    {
        return 'https://kauth.kakao.com/oauth/token';
    }
    
    public function redirectToKakao()
    {
        return Socialite::driver('kakao')->redirect();
    }

    public function handleKakaoCallback()
    {
        try {
            $socialUser = Socialite::driver('kakao')->stateless()->user();
            return $this->handleSocialLogin($socialUser, 'kakao');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Kakao 로그인 중 오류가 발생했습니다.');
        }
    }

    // ----------------------
    // 공통 소셜 로그인 처리 로직
    // ----------------------
    protected function handleSocialLogin($socialUser, $provider)
    {
        // 1. 이미 해당 소셜 계정이 연계되어 있다면 바로 로그인
        $user = User::where('provider', $provider)
                    ->where('provider_id', $socialUser->getId())
                    ->first();

        if ($user) {
            Auth::login($user);
            return redirect('/users');
        }

        // 2. 동일한 이메일이 존재하는 경우, 계정 연계를 위한 페이지로 이동
        $existingUser = User::where('email', $socialUser->getEmail())->first();
        if ($existingUser) {
            return redirect('/link-social-account')
                ->with('email', $socialUser->getEmail())
                ->with('provider', $provider)
                ->with('provider_id', $socialUser->getId());
        }

        // 3. 새로운 사용자 생성 후 로그인
        $newUser = User::create([
            'name'         => $socialUser->getName() ?: $socialUser->getNickname(),
            'email'        => $socialUser->getEmail(),
            'provider'     => $provider,
            'provider_id'  => $socialUser->getId(),
            'password'     => bcrypt(str()->random(16)), // 임의 비밀번호 생성
        ]);

        Auth::login($newUser);
        return redirect('/users');
    }

}
