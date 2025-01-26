@extends('layouts.app')

@section('content')
    <h2 class="text-lg text-bold text-center mb-6">새 게시물 작성하기</h2>
    <form class="flex flex-col gap-6" id="createPost" action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="flex flex-col gap-1"><label class="bold text-left" for="title">제목</label><input class="border border-gray-200 bg-slate-200 rounded-xl  p-2" type="text" name="title" required placeholder="제목을 입력해주세요"/> </div>
        <div class="flex flex-col gap-1"><label class="bold text-left"  for="content">내용</label><textarea class="border border-gray-200 bg-slate-200 rounded-xl  p-2" name="content" required placeholder="내용을 입력해주세요" cols="5"></textarea></div>
        <div class="flex flex-col gap-1"><label class="bold text-left"  for="writer">작성자</label> <input class="border border-gray-200 bg-slate-200 rounded-xl  p-2" type="text" name="writer" required placeholder="작성자 성함을 입력해주세요" /></div>
        <div class="flex flex-row gap-4 mx-auto items-center">
            <button class="bg-blue-500 text-white rounded-3xl px-3 py-2" type="submit">보존하기</button>
            <a href="{{ route('posts.index') }}">뒤돌아가기</a>
        </div>
    </form>
@endsection
