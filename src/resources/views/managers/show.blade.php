@extends('layouts.app')

@section('content')
<div class="container">
    <h2>매니저 정보 수정</h2>

    <form action="{{ route('managers.update', $manager->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">이름</label>
            <input type="text" name="name" class="form-control" value="{{ $manager->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">전화번호</label>
            <input type="text" name="phone" class="form-control" value="{{ $manager->phone }}">
        </div>

        <div class="mb-3">
            <label class="form-label">부서</label>
            <input type="text" name="department" class="form-control" value="{{ $manager->department }}">
        </div>

        @if(auth('manager')->user()->role == 0)
        <div class="mb-3">
            <label class="form-label">권한</label>
            <select name="role" class="form-control">
                <option value="1" {{ $manager->role == 1 ? 'selected' : '' }}>일반 관리자</option>
                <option value="0" {{ $manager->role == 0 ? 'selected' : '' }}>최고 관리자</option>
            </select>
        </div>
        @endif

        <button type="submit" class="btn btn-warning">수정하기</button>
        <button type="button" class="btn btn-secondary" onclick="history.back();">뒤로가기</button>
    </form>
</div>
@endsection
