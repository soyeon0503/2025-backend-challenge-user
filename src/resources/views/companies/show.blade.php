@extends('layouts.app')

@section('content')
<div class="container">
    <h2>회사 정보</h2>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $company->name }}</h4>
            <p><strong>주소:</strong> {{ $company->address }}</p>
            <p><strong>전화번호:</strong> {{ $company->phone }}</p>
            <p><strong>이메일:</strong> {{ $company->email }}</p>
            <p><strong>웹사이트:</strong> <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></p>
            <p><strong>설명:</strong> {{ $company->description }}</p>
            <p><strong>상태:</strong> {{ $company->status }}</p>
        </div>
    </div>

    <a href="{{ route('posts.index') }}" class="btn btn-primary mt-3">상품 게시물 보기</a>
    <button type="button" class="btn btn-secondary" onclick="history.back();">
        뒤로가기
    </button>
</div>
@endsection
