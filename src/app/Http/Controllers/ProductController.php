<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Manager;

class ProductController extends Controller
{
    /**
     * 로그인한 관리자의 회사가 관리하는 상품 목록 조회
     */
    public function index()
    {
        $manager = Auth::guard('manager')->user();
        if (!$manager) {
            return redirect()->route('manager.login')->with('error', '로그인 후 이용해주세요.');
        }

        $products = Product::where('company_id', $manager->company_id)->get();
        return view('products.index', compact('products'));
    }

    /**
     * 상품 등록 폼
     */
    public function create()
    {
        $manager = Auth::guard('manager')->user();
        if (!$manager) {
            return redirect()->route('manager.login')->with('error', '로그인 후 이용해주세요.');
        }

        return view('products.create');
    }

    /**
     * 상품 저장 (해당 회사의 직원이면 등록 가능)
     */
    public function store(Request $request)
    {
        $manager = Auth::guard('manager')->user();
        if (!$manager) {
            return redirect()->route('manager.login')->with('error', '로그인 후 이용해주세요.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'required|string|max:50',
        ]);

        Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
            'company_id' => $manager->company_id,
            'manager_id' => $manager->id,
        ]);

        return redirect()->route('products.index')->with('success', '상품이 등록되었습니다.');
    }

    /**
     * 특정 상품 조회
     */
    public function show(Product $product)
    {
        $manager = Auth::guard('manager')->user();
        if (!$manager || $product->company_id !== $manager->company_id) {
            return abort(403, '권한이 없습니다.');
        }

        return view('products.show', compact('product'));
    }

    /**
     * 상품 수정 폼
     */
    public function edit(Product $product)
    {
        $manager = Auth::guard('manager')->user();
        if (!$manager || $product->company_id !== $manager->company_id) {
            return abort(403, '권한이 없습니다.');
        }

        return view('products.edit', compact('product'));
    }

    /**
     * 상품 업데이트
     */
    public function update(Request $request, Product $product)
    {
        $manager = Auth::guard('manager')->user();
        if (!$manager || $product->company_id !== $manager->company_id) {
            return abort(403, '권한이 없습니다.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'required|string|max:50',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', '상품이 수정되었습니다.');
    }

    /**
     * 상품 삭제
     */
    public function destroy(Product $product)
    {
        $manager = Auth::guard('manager')->user();
        if (!$manager || $product->company_id !== $manager->company_id) {
            return abort(403, '권한이 없습니다.');
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', '상품이 삭제되었습니다.');
    }
}
