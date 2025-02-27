@extends('layouts.app')

@section('title', '소셜 계정 연계')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">소셜 계정 연계</h2>

            <p>이메일 <strong>{{ $email }}</strong> 은 이미 가입되어 있습니다.</p>
            <p>{{ ucfirst($provider) }} 계정을 기존 계정과 연계하시겠습니까?</p>

            <form method="POST" action="{{ url('/link-social-account') }}">
                @csrf
                <input type="hidden" name="provider" value="{{ $provider }}">
                <input type="hidden" name="provider_id" value="{{ $provider_id }}">
                <button type="submit" class="btn btn-primary w-100">계정 연계하기</button>
            </form>

            <a href="/login" class="btn btn-secondary w-100 mt-2">취소</a>
        </div>
    </div>
@endsection
