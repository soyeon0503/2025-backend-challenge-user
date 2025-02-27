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
    <div class="mx-auto flex justify-center items-center flex-col gap-4 mt-8">
        <a href="{{ url('/auth/google') }}">
            <button class="gsi-material-button">
                <div class="gsi-material-button-state"></div>
                <div class="gsi-material-button-content-wrapper">
                    <div class="gsi-material-button-icon">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;">
                            <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                            <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                            <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                            <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                            <path fill="none" d="M0 0h48v48H0z"></path>
                        </svg>
                    </div>
                    <span class="gsi-material-button-contents">Sign in with Google</span>
                    <span style="display: none;">Sign in with Google</span>
                </div>
            </button>
        </a>

        <a href="{{ url('/auth/kakao') }}">
            <img src="{{ asset('images/kakao_login_button.png') }}" alt="Kakao 계정으로 로그인" class="img-fluid mb-2" style="max-width: 100%; height: auto;">
        </a>
    </div>


@endsection
