@extends('layouts.app')

@section('content')
<h2 class="text-lg text-bold">비밀번호 수정</h2>

<form class="max-w-md flex flex-col gap-4 mx-auto mt-8" action="{{ route('users.store') }}" method="POST">
    <div>번호 : {{$user->id }}</div>
    <div>이름 : {{$user->name}}</div>
    <div>이메일 : {{$user->email}}</div>
    @csrf
    <div class="flex flex-col gap-1">
        <label for="new_password" class="text-md font-bold">새 비밀번호</label>
        <input class="px-2 py-2 border border-gray-800" id="new_password" type="password"  name="new_password" required>
        @error('new_password')
            <span class="text-red-600 mt-1" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="flex flex-col gap-1">
        <label for="new_password_confirmation" class="text-md font-bold">새 비밀번호확인</label>
            <input class="px-2 py-2 border border-gray-800" id="new_password_confirmation" type="password"  name="new_password_confirmation" required >
            @error('new_password_confirmation')
                <span class="text-red-600 mt-1" role="alert">
                    {{ $message }}
                </span>
            @enderror
    </div>

    <button class="rounded-full px-4 py-2 text-white bg-violet-500 hover:bg-violet-900" type="submit">비밀번호 변경</button>
    <button type="button" class="btn btn-secondary" onclick="history.back();">
        뒤로가기
    </button>
</form>

@endsection