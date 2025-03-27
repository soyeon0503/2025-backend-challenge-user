<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Product;

class PostController extends Controller
{
    /**
     * 게시물 목록 조회 (모든 사용자가 접근 가능)
     */
    public function index()
    {
        $posts = Post::with('product', 'company', 'manager')->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * 특정 게시물 상세 조회 (모든 사용자가 접근 가능)
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * 게시물 작성 폼 (회사 관리자만 가능)
     */
    public function create()
    {
        $manager = Auth::guard('manager')->user();
        if (!$manager) {
            return redirect()->route('posts.index')->with('error', '접근 권한이 없습니다.');
        }

        // 현재 회사의 제품만 가져오기
        $products = $manager->company->product;

        return view('posts.create', compact('products'));
    }

    /**
     * 게시물 저장 (회사 관리자만 가능)
     */
    public function store(Request $request)
    {
        $manager = Auth::guard('manager')->user();
        if (!$manager) {
            return redirect()->route('posts.index')->with('error', '접근 권한이 없습니다.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'product_id' => 'required|exists:products,id',
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'company_id' => $manager->company_id,
            'manager_id' => $manager->id,
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('posts.index')->with('success', '게시물이 등록되었습니다.');
    }

    /**
     * 게시물 수정 폼 (해당 회사 직원만 가능)
     */
    public function edit(Post $post)
    {
        $manager = Auth::guard('manager')->user();
        if (!$manager || $post->company_id !== $manager->company_id) {
            return abort(403, '권한이 없습니다.');
        }

        // 현재 회사의 제품만 선택 가능하도록
        $products = Product::where('company_id', $manager->company_id)->get();

        return view('posts.edit', compact('post', 'products'));
    }

    /**
     * 게시물 업데이트 (해당 회사 직원만 가능)
     */
    public function update(Request $request, Post $post)
    {
        $manager = Auth::guard('manager')->user();
        if (!$manager || $post->company_id !== $manager->company_id) {
            return abort(403, '권한이 없습니다.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'product_id' => 'required|exists:products,id',
        ]);

        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'product_id' => $validated['product_id'],
        ]);

        return redirect()->route('posts.index')->with('success', '게시물이 수정되었습니다.');
    }

    /**
     * 게시물 삭제 (해당 회사 직원만 가능)
     */
    public function destroy(Post $post)
    {
        $manager = Auth::guard('manager')->user();
        if (!$manager || $post->company_id !== $manager->company_id) {
            return abort(403, '권한이 없습니다.');
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', '게시물이 삭제되었습니다.');
    }
}
