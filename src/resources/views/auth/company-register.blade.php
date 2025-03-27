@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center text-lg font-bold">회사 회원가입</h2>

    <form class="max-w-md flex flex-col gap-6 mx-auto" method="POST" action="{{ route('companies.store') }}">
        @csrf

        <!-- 회사 정보 입력 -->
        <h3 class="text-md font-bold">회사 정보</h3>

        <div class="flex flex-col gap-1">
            <label>회사명</label>
            <input type="text" name="name" class="px-2 py-2 border border-gray-800" required>
        </div>

        <div class="flex flex-col gap-1">
            <label>회사 주소</label>
            <input type="text" name="address" class="px-2 py-2 border border-gray-800">
        </div>

        <div class="flex flex-col gap-1">
            <label>회사 전화번호</label>
            <input type="text" name="phone" class="px-2 py-2 border border-gray-800">
        </div>

        <div class="flex flex-col gap-1">
            <label>회사 이메일</label>
            <input type="email" name="email" class="px-2 py-2 border border-gray-800">
        </div>

        <div class="flex flex-col gap-1">
            <label>웹사이트</label>
            <input type="text" name="website" class="px-2 py-2 border border-gray-800">
        </div>

        <div class="flex flex-col gap-1">
            <label>설명</label>
            <textarea name="description" class="px-2 py-2 border border-gray-800"></textarea>
        </div>

        <!-- 최고 관리자 정보 입력 -->
        <h3 class="text-md font-bold mt-6">최고 관리자 정보</h3>

        <div class="flex flex-col gap-1">
            <label>이름</label>
            <input type="text" name="manager_name" class="px-2 py-2 border border-gray-800" required>
        </div>

        <div class="flex flex-col gap-1">
            <label>이메일</label>
            <input type="email" name="manager_email" class="px-2 py-2 border border-gray-800" required>
        </div>

        <div class="flex flex-col gap-1">
            <label>비밀번호</label>
            <input type="password" name="manager_password" class="px-2 py-2 border border-gray-800" required>
        </div>

        <div class="flex flex-col gap-1">
            <label>비밀번호 확인</label>
            <input type="password" name="manager_password_confirmation" class="px-2 py-2 border border-gray-800" required>
        </div>

        <div class="flex flex-col gap-1">
            <label>전화번호</label>
            <input type="text" name="manager_phone" class="px-2 py-2 border border-gray-800">
        </div>

        <div class="flex flex-col gap-1">
            <label>부서</label>
            <input type="text" name="manager_department" class="px-2 py-2 border border-gray-800">
        </div>

        <!-- 제출 버튼 -->
        <button class="rounded-full px-4 py-2 text-white bg-violet-500 hover:bg-violet-900" type="submit">
            회사 등록
        </button>

        <!-- 뒤로가기 버튼 -->
        <button type="button" class="btn btn-secondary mt-3" onclick="history.back();">뒤로가기</button>
    </form>
</div>
@endsection
