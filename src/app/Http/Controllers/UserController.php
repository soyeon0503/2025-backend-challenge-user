<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // 1. 게시물 목록 조회
    public function index()
    {
        $users = User::all(); // 모든 게시물 가져오기
        return view('users.index', compact('users'));
    }

    // 4. 특정 게시물 조회
    public function show(string $id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit(string $id){
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }
    
    public function store(Request $request)
    {
        // 1. 입력값 검증 (새 비밀번호와 확인 비밀번호가 일치해야 함)
        $request->validate([
            'new_password' => 'required|min:8',
            'new_password_confirmation' => 'required|min:8|same:new_password',
        ], [
            'new_password.required' => '새 비밀번호를 입력해주세요.',
            'new_password.min' => '새 비밀번호는 최소 8자 이상이어야 합니다.',
            'new_password_confirmation.required' => '새 비밀번호 확인을 입력해주세요.',
            'new_password_confirmation.min' => '새 비밀번호 확인은 최소 8자 이상이어야 합니다.',
            'new_password_confirmation.same' => '새 비밀번호와 비밀번호 확인이 일치하지 않습니다.',
        ]);
    
        // 2. 현재 로그인된 사용자 가져오기
        $user = Auth::user();
    
        // 3. 비밀번호 업데이트
        $user->password = Hash::make($request->new_password);
        $user->save();
    
        // 4. 성공 메시지 반환
        return redirect()->route('users.index')->with('success', '비밀번호가 변경되었습니다.');
    }
    

    // 7. 게시물 삭제
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'user deleted successfully.');
    }
}
