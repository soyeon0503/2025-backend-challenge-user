<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 1. 게시물 목록 조회
    public function index()
    {
        $posts = Post::all(); // 모든 게시물 가져오기
        return view('posts.index', compact('posts'));
    }

    // 2. 게시물 작성 폼
    public function create()
    {
        return view('posts.create');
    }

    // 3. 게시물 저장
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'writer' => 'required',
        ]);

        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    // 4. 특정 게시물 조회
    public function show(string $id)
    {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    // 5. 게시물 수정 폼
    public function edit(string $id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }

    // 6. 게시물 업데이트
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'writer' => 'required',
    ]);

    $post = Post::findOrFail($id);
    $post->update($validated);

    return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
}


    // 7. 게시물 삭제
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
