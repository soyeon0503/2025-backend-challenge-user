@extends('layouts.app')

@section('content')
    <h2 class="text-lg text-bold">회원 정보</h2>
    <div class="flex flex-col gap-2 text-left mt-6 mb-6">
        <div>번호 : {{ $user->id }}</div>
        <div>이름 : {{ $user->name }}</div>
        <div>이메일 : {{ $user->email }}</div>
        <div>등록일자 : {{ $user->created_at }}</div>
        <div>수정일자 : {{ $user->updated_at }}</div>
        <a href="{{ route('users.edit', $user->id) }}">비밀번호 수정</a>
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="text-red-500" type="submit">삭제</button>
        </form>
    </div>

    <!-- 유저가 좋아요한 상품 목록 -->
    <div class="mt-6">
        <h3 class="text-lg font-bold">좋아요한 상품</h3>
        @if($likedProducts->isEmpty())
            <p>좋아요한 상품이 없습니다.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>상품명</th>
                        <th>회사</th>
                        <th>관리</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($likedProducts as $product)
                        <tr>
                            <!-- 상품 제목 클릭 시 포스트 상세 페이지로 이동 -->
                            <td>
                                @if($product->post)
                                    <a href="{{ route('posts.show', $product->post->id) }}">{{ $product->name }}</a>
                                @else
                                    {{ $product->name }} (연결된 포스트 없음)
                                @endif
                            </td>
                            <td>{{ $product->company->name }}</td>
                            <td>
                                <button class="btn btn-danger like-toggle" data-id="{{ $product->id }}">
                                    ❤️ 취소
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- 유저가 저장한 상품 목록 -->
    <div class="mt-6">
        <h3 class="text-lg font-bold">저장한 상품</h3>
        @if($savedProducts->isEmpty())
            <p>저장한 상품이 없습니다.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>상품명</th>
                        <th>회사</th>
                        <th>관리</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($savedProducts as $product)
                        <tr>
                            <!-- 상품 제목 클릭 시 포스트 상세 페이지로 이동 -->
                            <td>
                                @if($product->post)
                                    <a href="{{ route('posts.show', $product->post->id) }}">{{ $product->name }}</a>
                                @else
                                    {{ $product->name }} (연결된 포스트 없음)
                                @endif
                            </td>
                            <td>{{ $product->company->name }}</td>
                            <td>
                                <button class="btn btn-warning save-toggle" data-id="{{ $product->id }}">
                                    🔖 취소
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="flex justify-center items-center mt-4">
        <button type="button" class="underline text-center" onclick="location.href = '{{ url()->previous() }}'">
            뒤로가기
        </button>
    </div>
@endsection
