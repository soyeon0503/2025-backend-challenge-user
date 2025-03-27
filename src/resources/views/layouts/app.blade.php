<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>2025-backend-challenge-user</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net" rel="preconnect">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('scripts')
    </head>
    <body class="mx-auto">
        <nav>
            <ul class="flex justify-center gap-4 p-4 bg-gray-800 text-white">
                <li><a href="{{ route('posts.index') }}">게시글 목록</a></li>
        
                @if(Auth::guard('web')->check()) {{-- 일반 유저 로그인 상태 --}}
                    <li><a href="{{ route('users.show', auth()->user()) }}">내 정보</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">로그아웃</button>
                        </form>
                    </li>
                @elseif(Auth::guard('manager')->check()) {{-- 매니저 로그인 상태 --}}
                    <li><a href="{{ route('users.index') }}">사용자 목록</a></li>
                    <li><a href="{{ route('managers.index') }}">매니저 목록</a></li>
                    <li><a href="{{ route('products.index') }}">상품 목록</a></li>
                    <li><a href="{{ route('companies.show', auth()->guard('manager')->user()->company_id) }}">내 회사 관리</a></li>
                    <li>
                        <form action="{{ route('manager.logout') }}" method="POST">
                            @csrf
                            <button type="submit">관리자 로그아웃</button>
                        </form>
                    </li>
                @else {{-- 로그인 안 한 경우 --}}
                    <li><a href="{{ route('login') }}">유저 로그인</a></li>
                    <li><a href="{{ route('manager.login') }}">관리자 로그인</a></li>
                @endif
            </ul>
        </nav>        
        <main class="w-2/3 p-4 mx-auto">
            @yield('content')
        </main>
    </body>
</html>
