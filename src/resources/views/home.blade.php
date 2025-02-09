@extends('layouts.app')

@section('content')
<div class="container">
    <p>로그인되었습니다!</p>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">로그아웃</button>
    </form>
</div>
@endsection
