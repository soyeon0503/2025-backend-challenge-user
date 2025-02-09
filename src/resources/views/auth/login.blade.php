@extends('layouts.app')

@section('content')
    <form class="max-w-md flex flex-col gap-6 mx-auto" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="flex flex-col gap-4">
            <div class="flex flex-col gap-1">
                <label for="email" class="text-md font-bold">이메일</label>
                <input class="px-2 py-2 border border-gray-800" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="text-red-600 mt-1" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="password" class="text-md font-bold">비밀번호</label>

                    <input class="px-2 py-2 border border-gray-800" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="text-red-600 mt-1" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
            </div>
        </div>
      

        <div class="flex flex-col gap-4 justify-center">
            <button class="rounded-full px-4 py-2 text-white bg-violet-500 hover:bg-violet-900" type="submit">
                로그인
            </button>

            @if (Route::has('password.request'))
                <a class="underline text-center" href="{{ route('password.request') }}">
                    비밀번호 찾기
                </a>
            @endif
            <a class="underline text-center" href="{{ route('register') }}">
                회원가입
            </a>
        </div>
    </form>
@endsection
