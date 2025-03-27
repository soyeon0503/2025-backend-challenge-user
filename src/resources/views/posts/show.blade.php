@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $post->title }}</h2>

    <div class="mb-3">
        <strong>내용:</strong>
        <p>{{ $post->content }}</p>
    </div>

    <div class="mb-3">
        <strong>회사:</strong> {{ $post->company->name }}
    </div>

    <div class="mb-3">
        <strong>제품:</strong> {{ $post->product->name }}
    </div>

    <div class="mb-3">
        <strong>작성자:</strong> {{ $post->manager->name }}
    </div>

    @auth('manager')
        @if(auth('manager')->user()->id == $post->manager_id)
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">수정</a>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">삭제</button>
            </form>
        @endif
    @endauth
    <button type="button" class="btn btn-secondary" onclick="history.back();">
        뒤로가기
    </button>
</div>
@endsection
