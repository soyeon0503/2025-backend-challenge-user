@extends('layouts.app')

@section('content')
<div class="container">
    <h2>게시물 작성</h2>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <!-- 제목 입력 -->
        <div class="mb-3">
            <label for="title" class="form-label">제목</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <!-- 내용 입력 -->
        <div class="mb-3">
            <label for="content" class="form-label">내용</label>
            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
        </div>

        <!-- 회사 정보 (자동 입력) -->
        <div class="mb-3">
            <label class="form-label">회사</label>
            <input type="text" class="form-control" value="{{ auth('manager')->user()->company->name }}" disabled>
            <input type="hidden" name="company_id" value="{{ auth('manager')->user()->company_id }}">
        </div>

        <!-- 제품 선택 (해당 회사에서 관리하는 제품만 보이도록) -->
        <div class="mb-3">
            <label for="product_id" class="form-label">제품</label>
            <select name="product_id" id="product_id" class="form-control" required>
                @foreach(auth('manager')->user()->company->product as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- 작성자 정보 (자동 입력) -->
        <input type="hidden" name="manager_id" value="{{ auth('manager')->id() }}">

        <button type="submit" class="btn btn-primary">작성하기</button>
        <button type="button" class="btn btn-secondary" onclick="history.back();">
            뒤로가기
        </button>
    </form>
</div>
@endsection
