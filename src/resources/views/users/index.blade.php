@extends('layouts.app')

@section('content')
    <h2 class="text-lg text-bold">유저 리스트</h2>
    <div class="flex flex-row gap-5 justify-end items-center">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="bg-red-500 text-white rounded-3xl px-3 py-2" type="submit">로그아웃</button>
        </form>
    </div>

    @if (session('error'))
        <div class="bg-red-500 text-white px-4 py-3 rounded-lg mt-6 text-center">
            {{ session('error') }}
        </div>
    @endif
   
    <ul class="flex flex-col gap-4 mt-8">
        @foreach ($users as $user)
            <li class="flex flex-row gap-6">
                <div>{{ $user->id }}</div>
                <div>{{$user->name}}</div>
                <div>{{$user->email}}</div>
                <div>{{$user->created_at}}</div>
                <div>{{$user->updated_at}}</div>
                <a href="{{ route('users.show', $user->id) }}">상세</a>
                <a href="{{ route('users.edit', $user->id) }}">비밀번호수정</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500" type="submit">삭제</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
