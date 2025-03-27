@extends('layouts.app')

@section('content')
<div class="container">
    <h2>상품 목록</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">상품 추가</a>

    <table class="table">
        <thead>
            <tr>
                <th>이름</th>
                <th>가격</th>
                <th>상태</th>
                <th>관리</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->status }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">수정</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">삭제</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
