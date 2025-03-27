@extends('layouts.app')

@section('content')
<div class="container">
    <h2>매니저 정보 수정</h2>

    <form action="{{ route('managers.update', $manager->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">이름</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $manager->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">이메일</label>
            <input type="email" class="form-control" value="{{ $manager->email }}" disabled>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">전화번호</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $manager->phone }}">
        </div>

        <div class="mb-3">
            <label for="department" class="form-label">부서</label>
            <input type="text" name="department" id="department" class="form-control" value="{{ $manager->department }}">
        </div>

        <div class="mb-3">
            <label class="form-label">회사</label>
            <input type="text" class="form-control" value="{{ $manager->company->name }}" disabled>
        </div>

        <button type="submit" class="btn btn-warning">수정하기</button>
        <button type="button" class="btn btn-secondary" onclick="history.back();">뒤로가기</button>
    </form>
</div>
@endsection
