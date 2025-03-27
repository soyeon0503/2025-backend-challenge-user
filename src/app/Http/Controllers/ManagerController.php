<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Manager;
use App\Models\Company;

class ManagerController extends Controller
{
        /**
     * 관리자 로그인 폼 표시
     */
    public function showLoginForm()
    {
        return view('auth.manager-login');
    }

    /**
     * 관리자 로그인 처리
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('manager')->attempt($credentials)) {
            $manager = Auth::guard('manager')->user();
            return redirect()->route('companies.show', $manager->company_id)->with('success', '관리자 로그인 성공');
        }

        return back()->withErrors(['email' => '이메일 또는 비밀번호가 올바르지 않습니다.']);
    }


    /**
     * 관리자 로그아웃 처리
     */
    public function logout()
    {
        Auth::guard('manager')->logout();
        return redirect()->route('manager.login')->with('success', '관리자 로그아웃 완료');
    }

    public function index()
    {
        $manager = Auth::guard('manager')->user();

        if (!$manager) {
            return redirect()->route('manager.login')->with('error', '접근 권한이 없습니다.');
        }

        // 현재 로그인한 매니저가 속한 회사의 모든 매니저 조회
        $managers = Manager::where('company_id', $manager->company_id)->get();

        return view('managers.index', compact('managers'));
    }

    public function create()
    {
        $manager = Auth::guard('manager')->user();

        // 일반 매니저는 접근 불가
        if (!$manager || $manager->role != 0) {
            return abort(403, '권한이 없습니다.');
        }

        return view('managers.create');
    }

    public function edit(Manager $manager)
    {
        $currentManager = Auth::guard('manager')->user();

        if (!$currentManager || $currentManager->role != 0 || $currentManager->company_id !== $manager->company_id) {
            return abort(403, '권한이 없습니다.');
        }

        return view('managers.edit', compact('manager'));
    }

    public function store(Request $request)
    {
        $manager = Auth::guard('manager')->user();
    
        if (!$manager || $manager->role != 0) {
            return abort(403, '권한이 없습니다.');
        }
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:managers,email',
            'password' => 'required|min:8',
            'phone' => 'nullable|string|max:20',
            'department' => 'nullable|string|max:255',
            'role' => 'required|in:0,1',
        ]);
    
        Manager::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'department' => $validated['department'] ?? null,
            'company_id' => $manager->company_id,
            'role' => $validated['role'],
        ]);
    
        return redirect()->route('managers.index')->with('success', '새로운 관리자가 추가되었습니다.');
    }
    
    public function update(Request $request, Manager $manager)
    {
        $currentManager = Auth::guard('manager')->user();
    
        if (!$currentManager || $currentManager->company_id !== $manager->company_id) {
            return abort(403, '권한이 없습니다.');
        }
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'department' => 'nullable|string|max:255',
        ]);
    
        // 최고 관리자만 권한 변경 가능
        if ($currentManager->role == 0) {
            $validated['role'] = $request->validate([
                'role' => 'required|in:0,1',
            ])['role'];
        }
    
        $manager->update($validated);
    
        return redirect()->route('managers.index')->with('success', '매니저 정보가 수정되었습니다.');
    }
    

    // 회원 탈퇴
    public function delete()
    {
        $manager = Auth::user();
        $manager->delete();

        return response()->json(['message' => '회원 탈퇴가 완료되었습니다.'], 200);
    }
}
