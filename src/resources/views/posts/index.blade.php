@extends('layouts.app')

@section('content')
<div class="container">
    <h2>게시물 목록</h2>

    @auth('manager')
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">게시물 작성</a>
    @endauth

    <table class="table">
        <thead>
            <tr>
                <th>제목</th>
                <th>회사</th>
                <th>상품</th>
                <th>좋아요</th>
                <th>저장</th>
                @auth('manager')
                    <th>관리</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <!-- 제목 클릭 시 포스트 상세 페이지로 이동 -->
                    <td><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
                    <td>{{ $post->company->name }}</td>
                    <td>{{ $post->product->name }}</td>

                    <!-- 로그인 안 한 경우 기본 아이콘 표시 -->
                    @guest
                        <td>🤍</td>
                        <td>📄</td>
                    @endguest

                    <!-- 일반 유저 로그인 시 좋아요 & 저장 버튼 표시 -->
                    @auth('web')
                        <td>
                            <button class="btn btn-outline-danger like-btn" data-id="{{ $post->product->id }}">
                                {{ $post->product->likedByUser() ? '❤️' : '🤍' }}
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-outline-warning save-btn" data-id="{{ $post->product->id }}">
                                {{ $post->product->savedByUser() ? '🔖' : '📄' }}
                            </button>
                        </td>
                    @endauth

                    <!-- 관리자 로그인 시 관리 항목 표시 -->
                    @auth('manager')
                        @if(auth('manager')->user()->company_id === $post->company_id)
                            <td>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">수정</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">삭제</button>
                                </form>
                            </td>
                        @endif
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.like-btn').forEach(button => {
        button.addEventListener('click', function() {
            let productId = this.getAttribute('data-id');
            fetch(`/likes/${productId}/toggle`, { 
                method: 'POST', 
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } 
            })
            .then(response => response.json())
            .then(data => {
                this.innerText = data.liked ? '❤️' : '🤍';
            });
        });
    });

    document.querySelectorAll('.save-btn').forEach(button => {
        button.addEventListener('click', function() {
            let productId = this.getAttribute('data-id');
            fetch(`/saves/${productId}/toggle`, { 
                method: 'POST', 
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } 
            })
            .then(response => response.json())
            .then(data => {
                this.innerText = data.saved ? '🔖' : '📄';
            });
        });
    });
});
</script>
@endsection
