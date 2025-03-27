@extends('layouts.app')

@section('content')
<div class="container">
    <h2>매니저 추가</h2>

    <form action="{{ route('managers.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">이름</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">이메일</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">비밀번호</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">전화번호</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">부서</label>
            <input type="text" name="department" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">권한</label>
            <select name="role" class="form-control">
                <option value="1">일반 관리자</option>
                <option value="0">최고 관리자</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">추가하기</button>
        <button type="button" class="btn btn-secondary" onclick="history.back();">뒤로가기</button>
    </form>
</div>
@endsection
