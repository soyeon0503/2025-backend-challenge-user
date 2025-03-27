@extends('layouts.app')

@section('content')
<div class="container">
    <h2>회사 회원가입</h2>
    <form action="{{ route('companies.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">회사 이름</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">주소</label>
            <input type="text" name="address" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">전화번호</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">이메일</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">웹사이트</label>
            <input type="text" name="website" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">회사 설명</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">회사 상태</label>
            <input type="text" name="status" class="form-control">
        </div>

        <h4>직원 등록</h4>
        <div id="manager-container">
            <div class="manager-form">
                <div class="mb-3">
                    <label class="form-label">이름</label>
                    <input type="text" name="managers[0][name]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">이메일</label>
                    <input type="email" name="managers[0][email]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">비밀번호</label>
                    <input type="password" name="managers[0][password]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">전화번호</label>
                    <input type="text" name="managers[0][phone]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">부서</label>
                    <input type="text" name="managers[0][department]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">권한</label>
                    <select name="managers[0][role]" class="form-control">
                        <option value="0">최고 관리자</option>
                        <option value="1" selected>일반 관리자</option>
                    </select>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-secondary" onclick="addManager()">직원 추가</button>
        <button type="submit" class="btn btn-success">회사 등록</button>
        <button type="button" class="btn btn-secondary" onclick="history.back();">
            뒤로가기
        </button>
    </form>
</div>

<script>
    let managerIndex = 1;

    function addManager() {
        let container = document.getElementById('manager-container');
        let newManagerForm = document.createElement('div');
        newManagerForm.classList.add('manager-form');
        newManagerForm.innerHTML = `
            <hr>
            <div class="mb-3">
                <label class="form-label">이름</label>
                <input type="text" name="managers[\${managerIndex}][name]" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">이메일</label>
                <input type="email" name="managers[\${managerIndex}][email]" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">비밀번호</label>
                <input type="password" name="managers[\${managerIndex}][password]" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">전화번호</label>
                <input type="text" name="managers[\${managerIndex}][phone]" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">부서</label>
                <input type="text" name="managers[\${managerIndex}][department]" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">권한</label>
                <select name="managers[\${managerIndex}][role]" class="form-control">
                    <option value="0">최고 관리자</option>
                    <option value="1" selected>일반 관리자</option>
                </select>
            </div>
        `;
        container.appendChild(newManagerForm);
        managerIndex++;
    }
</script>
@endsection
