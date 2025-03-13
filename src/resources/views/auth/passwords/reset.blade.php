@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-xl text-center my-6">비밀번호 재설정</h2>

    <form class="max-w-md flex flex-col gap-6 mx-auto" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="flex flex-col gap-4">
            <div class="flex flex-col gap-1">
                <label for="email" class="text-md font-bold">이메일 입력</label>
                <input class="px-2 py-2 border border-gray-800" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="text-red-600 mt-1" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <button class="rounded-full px-4 py-2 text-white bg-violet-500 hover:bg-violet-900" type="submit">
            인증번호 보내기
        </button>
        <a class="underline text-center" href="{{ route('login') }}">
            뒤돌아가기
        </a>
    </form>
</div>
@endsection
