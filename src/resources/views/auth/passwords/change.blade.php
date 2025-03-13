@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-xl text-center my-6">새 비밀번호 설정</h2>

    <form class="max-w-md flex flex-col gap-6 mx-auto" method="POST" action="{{ route('password.change') }}">
        @csrf

        <div class="flex flex-col gap-4">
            <div class="flex flex-col gap-1">
                <label for="password" class="text-md font-bold">새 비밀번호</label>
                <input class="px-2 py-2 border border-gray-800" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                @error('password')
                    <span class="text-red-600 mt-1" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>

        </div>
        <div class="flex flex-col gap-1">
            <label for="password_confirmation" class="text-md font-bold">새 비밀번호 확인</label>
                <input class="px-2 py-2 border border-gray-800" id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required>
                @error('password_confirmation')
                    <span class="text-red-600 mt-1" role="alert">
                        {{ $message }}
                    </span>
                @enderror
        </div>

        <button type="submit" class="rounded-full px-4 py-2 text-white bg-violet-500 hover:bg-violet-900" >비밀번호 변경</button>
    </form>
</div>
@endsection
