<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Models\Manager;

class CompanyController extends Controller
{
    /**
     * 회사 회원가입 폼 (비로그인 상태에서만 접근 가능)
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * 회사 및 관리자 등록
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // 회사 정보
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:companies,email',
            'website' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|max:50',

            // 최소 1명 이상의 관리자 등록 필수
            'managers' => 'required|array|min:1',
            'managers.*.name' => 'required|string|max:255',
            'managers.*.email' => 'required|email|unique:managers,email',
            'managers.*.password' => 'required|min:8',
            'managers.*.phone' => 'nullable|string|max:20',
            'managers.*.department' => 'nullable|string|max:255',
            'managers.*.role' => 'required|in:0,1',
        ]);

        // 회사 등록
        $company = Company::create([
            'name' => $validated['name'],
            'address' => $validated['address'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'] ?? null,
            'website' => $validated['website'] ?? null,
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'] ?? 'active',
        ]);

        // 관리자 등록
        foreach ($validated['managers'] as $index => $managerData) {
            Manager::create([
                'name' => $managerData['name'],
                'email' => $managerData['email'],
                'password' => Hash::make($managerData['password']),
                'phone' => $managerData['phone'] ?? null,
                'department' => $managerData['department'] ?? null,
                'company_id' => $company->id,
                'role' => $managerData['role'],
            ]);
        }

        return redirect()->route('manager.login')->with('success', '회사 및 관리자가 등록되었습니다. 관리자 계정으로 로그인하세요.');
    }

    /**
     * 특정 회사 상세 조회
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * 회사 수정 폼 (최고 관리자만 접근 가능)
     */
    public function edit(Company $company)
    {
        $this->authorizeManager($company);
        return view('companies.edit', compact('company'));
    }

    /**
     * 회사 정보 수정 (최고 관리자만 가능)
     */
    public function update(Request $request, Company $company)
    {
        $this->authorizeManager($company);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|max:50',
        ]);

        $company->update($validated);

        return redirect()->route('companies.show', $company)->with('success', '회사 정보가 수정되었습니다.');
    }

    /**
     * 회사 삭제 (최고 관리자만 가능)
     */
    public function destroy(Company $company)
    {
        $this->authorizeManager($company);
        $company->delete();

        return redirect()->route('companies.index')->with('success', '회사가 삭제되었습니다.');
    }

    /**
     * 직원 추가 폼 (최고 관리자만 가능)
     */
    public function createManager(Company $company)
    {
        $this->authorizeManager($company);
        return view('managers.create', compact('company'));
    }

    /**
     * 직원 추가 (최고 관리자만 가능)
     */
    public function storeManager(Request $request, Company $company)
    {
        $this->authorizeManager($company);

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
            'company_id' => $company->id,
            'role' => $validated['role'],
        ]);

        return redirect()->route('companies.show', $company)->with('success', '직원이 추가되었습니다.');
    }

    /**
     * 최고 관리자 여부 확인
     */
    private function authorizeManager(Company $company)
    {
        $manager = Auth::guard('manager')->user();

        if (!$manager || $manager->company_id !== $company->id || $manager->role !== 0) {
            abort(403, '최고 관리자만 접근할 수 있습니다.');
        }
    }

    /**
     * 좋아요한 유저 목록 조회 (매니저 전용)
     */
    public function likedUsers()
    {
        $manager = Auth::guard('manager')->user();
        if (!$manager) {
            return redirect()->route('manager.login')->with('error', '로그인 후 이용해주세요.');
        }

        $products = $manager->company->product()->with('likedUsers')->get();

        return view('companies.liked_users', compact('products'));
    }

    /**
     * 저장한 유저 목록 조회 (매니저 전용)
     */
    public function savedUsers()
    {
        $manager = Auth::guard('manager')->user();
        if (!$manager) {
            return redirect()->route('manager.login')->with('error', '로그인 후 이용해주세요.');
        }

        $products = $manager->company->product()->with('savedUsers')->get();

        return view('companies.saved_users', compact('products'));
    }
}
