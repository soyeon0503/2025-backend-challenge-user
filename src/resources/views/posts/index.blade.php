@extends('layouts.app')

@section('content')
    <h2 class="text-lg text-bold">게시물 리스트</h2>
    <div class="text-right">
        <button class="bg-blue-500 text-white rounded-3xl px-3 py-2" onclick="window.location.href='{{ route('posts.create') }}'">
            새 글 작성
        </button>
    </div>
   
    <ul class="flex flex-col gap-4">
        @foreach ($posts as $post)
            <li class="flex flex-row gap-6">
                <a class="underline"  href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                <div>{{$post->writer}}</div>
                <a href="{{ route('posts.edit', $post->id) }}">수정</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500" type="submit">삭제</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
