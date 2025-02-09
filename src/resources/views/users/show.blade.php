@extends('layouts.app')

@section('content')
    <h2 class="text-lg text-bold">새 회원 정보</h2>
    <div class="flex flex-col gap-2 text-left mt-6 mb-6">
        <div>번호 : {{$user->id }}</div>
        <div>이름 : {{$user->name}}</div>
        <div>이메일 : {{$user->email}}</div>
        <div>등록일자 : {{$user->created_at}}</div>
        <div>수정일자 : {{$user->updated_at}}</div>
        <a href="{{ route('users.edit', $user->id) }}">비밀번호수정</a>
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="text-red-500" type="submit">삭제</button>
        </form>
    </div>
    <div class="flex justify-center items-center mt-4">
        <button type="button" class="underline text-center"  onclick="location.href = '{{ url()->previous() }}'">
            뒤돌아가기
        </button>
    </div>
@endsection
