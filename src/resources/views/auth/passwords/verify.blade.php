@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-xl text-center my-6">인증번호 입력</h2>
    <form class="max-w-md flex flex-col gap-6 mx-auto" method="POST" action="{{ route('password.verify.post') }}">
        @csrf

        <input type="hidden" name="email" value="{{ session('email') }}">

        <div class="flex flex-col gap-4">
            <div class="flex flex-col gap-1">
                <label for="verification_code" class="text-md font-bold">이메일로 받은 인증번호 입력</label>
                <input class="px-2 py-2 border border-gray-800" id="verification_code" type="text" class="form-control @error('verification_code') is-invalid @enderror" name="verification_code" required autofocus>
                @error('verification_code')
                    <span class="text-red-600 mt-1" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <button class="rounded-full px-4 py-2 text-white bg-violet-500 hover:bg-violet-900" type="submit">
            인증하기
        </button>
    </form>
</div>
@endsection
