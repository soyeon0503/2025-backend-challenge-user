@extends('layouts.app')

@section('content')
<div class="container">
    <h2>매니저 상세 정보</h2>

    <div class="mb-3">
        <strong>이름:</strong> {{ $manager->name }}
    </div>

    <div class="mb-3">
        <strong>이메일:</strong> {{ $manager->email }}
    </div>

    <div class="mb-3">
        <strong>전화번호:</strong> {{ $manager->phone ?? '없음' }}
    </div>

    <div class="mb-3">
        <strong>부서:</strong> {{ $manager->department ?? '없음' }}
    </div>

    <div class="mb-3">
        <strong>회사:</strong> {{ $manager->company->name }}
    </div>

    <div class="mb-3">
        <strong>권한:</strong> {{ $manager->role == 0 ? '최고 관리자' : '일반 관리자' }}
    </div>

    @if(auth('manager')->user()->role == 0)
        <a href="{{ route('managers.edit', $manager->id) }}" class="btn btn-warning">수정</a>
    @endif

    <!-- 뒤로가기 버튼 -->
    <button type="button" class="btn btn-secondary mt-3" onclick="history.back();">뒤로가기</button>
</div>
@endsection
