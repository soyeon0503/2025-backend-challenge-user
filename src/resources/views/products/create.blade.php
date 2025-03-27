@extends('layouts.app')

@section('content')
<div class="container">
    <h2>상품 등록</h2>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">상품 이름</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">가격</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">설명</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">상태</label>
            <input type="text" name="status" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">등록</button>
        <button type="button" class="btn btn-secondary" onclick="history.back();">
            뒤로가기
        </button>
    </form>
</div>
@endsection
