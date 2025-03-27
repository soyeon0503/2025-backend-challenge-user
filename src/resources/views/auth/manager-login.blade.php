@extends('layouts.app')

@section('content')
    <form class="max-w-md flex flex-col gap-6 mx-auto" method="POST" action="{{ route('manager.login') }}">
        @csrf
        <h2 class="text-center text-lg font-bold">회사 관리자 로그인</h2>
        
        <div class="flex flex-col gap-4">
            <label>이메일</label>
            <input type="email" name="email" class="px-2 py-2 border border-gray-800" required>

            <label>비밀번호</label>
            <input type="password" name="password" class="px-2 py-2 border border-gray-800" required>
        </div>

        <button class="rounded-full px-4 py-2 text-white bg-violet-500 hover:bg-violet-900" type="submit">
            관리자 로그인
        </button>
    </form>
@endsection
