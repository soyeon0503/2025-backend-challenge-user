@extends('layouts.app')

@section('content')
    <h2>게시물 상세보기</h2>

        <div>제목 : {{ $post->title }}</div>
        <div>내용 : {{ $post->content}}</div>
        <div>작성자 : {{$post->writer}}</div>
        <a href="{{ route('posts.edit', $post->id) }}">수정</a>
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">삭제</button>
        </form>
        <a href="{{ route('posts.index') }}">뒤돌아가기</a>
@endsection
