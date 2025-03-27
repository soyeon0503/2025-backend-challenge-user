@extends('layouts.app')

@section('content')
<div class="container">
    <h2>게시물 수정</h2>

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- 제목 수정 -->
        <div class="mb-3">
            <label for="title" class="form-label">제목</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" required>
        </div>

        <!-- 내용 수정 -->
        <div class="mb-3">
            <label for="content" class="form-label">내용</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ $post->content }}</textarea>
        </div>

        <!-- 회사 정보 (변경 불가) -->
        <div class="mb-3">
            <label class="form-label">회사</label>
            <input type="text" class="form-control" value="{{ $post->company->name }}" disabled>
        </div>

        <!-- 제품 선택 (현재 회사 제품만 선택 가능) -->
        <div class="mb-3">
            <label for="product_id" class="form-label">제품</label>
            <select name="product_id" id="product_id" class="form-control" required>
                @foreach(auth('manager')->user()->company->product as $product)
                    <option value="{{ $product->id }}" {{ $product->id == $post->product_id ? 'selected' : '' }}>{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-warning">수정하기</button>
        <button type="button" class="btn btn-secondary" onclick="history.back();">
            뒤로가기
        </button>
    </form>
</div>
@endsection
