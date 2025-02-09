@extends('layouts.app')

@section('content')
<h2 class="text-xl text-center mb-6">회원가입</h2>
<form class="max-w-md flex flex-col gap-6 mx-auto" method="POST" action="{{ route('register') }}">
    @csrf
    <div class="flex flex-col gap-4">
        <div class="flex flex-col gap-1">
            <label for="name" class="text-md font-bold">이름</label>
            <input class="px-2 py-2 border border-gray-800" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required >
            @error('name')
                <span class="text-red-600 mt-1" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="flex flex-col gap-1">
            <label for="email" class="text-md font-bold">이메일</label>
            <input class="px-2 py-2 border border-gray-800" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="text-red-600 mt-1" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="flex flex-col gap-1">
            <label for="password" class="text-md font-bold">비밀번호</label>
            <input class="px-2 py-2 border border-gray-800" id="password" type="password"  name="password" required autocomplete="current-password">
            @error('password')
                <span class="text-red-600 mt-1" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="flex flex-col gap-1">
            <label for="password-confirm" class="text-md font-bold">비밀번호확인</label>
                <input class="px-2 py-2 border border-gray-800" id="password-confirm" type="password"  name="password_confirmation" required >
                @error('password_confirmation')
                    <span class="text-red-600 mt-1" role="alert">
                        {{ $message }}
                    </span>
                @enderror
        </div>

    </div>
  

    <div class="flex flex-col gap-4 justify-center">
        <button class="rounded-full px-4 py-2 text-white bg-violet-500 hover:bg-violet-900" type="submit">
            가입하기
        </button>
    </div>
</form>
<div class="flex justify-center items-center mt-4">
    <button type="button" class="underline text-center"  onclick="location.href = '{{ url()->previous() }}'">
        뒤돌아가기
    </button>
</div>
@endsection
