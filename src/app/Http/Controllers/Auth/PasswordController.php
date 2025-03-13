<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\VerificationCodeMail;

class PasswordController extends Controller
{
    // 비밀번호 재설정 - 이메일 입력 페이지
    public function showResetForm()
    {
        return view('auth.passwords.reset');
    }

    // 이메일로 인증번호 전송
    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // 이메일 존재 확인
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => '등록되지 않은 이메일입니다.']);
        }

        // 소셜 로그인 계정인지 확인 (Google, Kakao)
        if (!is_null($user->provider)) {
            return back()->withErrors(['email' => '소셜 로그인 계정입니다. 비밀번호 재설정을 진행할 수 없습니다. ']);
        }

        // 6자리 인증번호 생성
        $verificationCode = random_int(100000, 999999);
        $expiresAt = now()->addMinutes(5); // 5분 후 만료

        // password_reset_tokens 테이블 업데이트
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'verification_code' => $verificationCode,
                'expires_at' => $expiresAt,
                'created_at' => now(),
            ]
        );

        // 이메일 발송
        Mail::to($request->email)->send(new VerificationCodeMail($verificationCode));

        return redirect()->route('password.verify')->with('email', $request->email);
    }

    // 인증번호 입력 페이지
    public function showVerifyForm(Request $request)
    {
        return view('auth.passwords.verify');
    }

    // 인증번호 검증
    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'verification_code' => 'required|digits:6',
        ]);

        $tokenData = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$tokenData) {
            return back()->withErrors(['verification_code' => '인증번호가 존재하지 않습니다.']);
        }

        if ($tokenData->verification_code != $request->verification_code) {
            return back()->withErrors(['verification_code' => '인증번호가 일치하지 않습니다.']);
        }

        if (now()->greaterThan($tokenData->expires_at)) {
            return back()->withErrors(['verification_code' => '인증번호가 만료되었습니다.']);
        }

        // 인증 성공 → 비밀번호 변경 페이지로 이동
        session()->put('password_reset_verified', true);
        session()->put('password_reset_email', $request->email);

        return redirect()->route('password.change.form');
    }

    // 비밀번호 변경 페이지
    public function showChangePasswordForm(Request $request)
    {
        // 인증이 완료되지 않았으면 접근 불가
        if (!session()->has('password_reset_verified')) {
            return redirect()->route('password.verify')->withErrors(['message' => '먼저 인증번호를 확인해주세요.']);
        }

        return view('auth.passwords.change');
    }

    // 비밀번호 변경 처리
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $email = session()->get('password_reset_email');

        if (!$email) {
            return redirect()->route('password.verify')->withErrors(['message' => '인증 세션이 만료되었습니다. 다시 시도해주세요.']);
        }

        // 비밀번호 변경
        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->route('password.verify')->withErrors(['message' => '사용자를 찾을 수 없습니다.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // 사용 후 세션 삭제
        session()->forget(['password_reset_verified', 'password_reset_email']);

        return redirect()->route('login')->with('success', '비밀번호가 변경되었습니다. 다시 로그인하세요.');
    }
}
