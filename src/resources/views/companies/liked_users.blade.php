@extends('layouts.app')

@section('content')
<div class="container">
    <h2>좋아요한 유저 목록</h2>

    @foreach($products as $product)
        <div class="card mt-3">
            <div class="card-body">
                <h4 class="card-title">{{ $product->name }}</h4>
                <p><strong>좋아요한 유저:</strong></p>
                @if($product->likedUsers->isEmpty())
                    <p>좋아요한 유저가 없습니다.</p>
                @else
                    <ul>
                        @foreach($product->likedUsers as $user)
                            <li>{{ $user->name }} ({{ $user->email }})</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @endforeach
    <button type="button" class="btn btn-secondary" onclick="history.back();">
        뒤로가기
    </button>
</div>
@endsection
