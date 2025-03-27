@extends('layouts.app')

@section('content')
<div class="container">
    <h2>매니저 목록 ({{ auth('manager')->user()->company->name }})</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- 최고 관리자만 추가 가능 -->
    @if(auth('manager')->user()->role == 0)
        <a href="{{ route('managers.create') }}" class="btn btn-primary mb-3">매니저 추가</a>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>이름</th>
                <th>이메일</th>
                <th>전화번호</th>
                <th>부서</th>
                <th>권한</th>
                <th>관리</th>
            </tr>
        </thead>
        <tbody>
            @foreach($managers as $manager)
                <tr>
                    <td><a href="{{ route('managers.show', $manager->id) }}">{{ $manager->name }}</a></td>
                    <td>{{ $manager->email }}</td>
                    <td>{{ $manager->phone ?? '없음' }}</td>
                    <td>{{ $manager->department ?? '없음' }}</td>
                    <td>{{ $manager->role == 0 ? '최고 관리자' : '일반 관리자' }}</td>
                    
                    @if(auth('manager')->user()->role == 0)
                        <td>
                            <a href="{{ route('managers.edit', $manager->id) }}" class="btn btn-warning btn-sm">수정</a>
                            <form action="{{ route('managers.destroy', $manager->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">삭제</button>
                            </form>
                        </td>
                    @else
                        <td>-</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <button type="button" class="btn btn-secondary mt-3" onclick="history.back();">뒤로가기</button>
</div>
@endsection
