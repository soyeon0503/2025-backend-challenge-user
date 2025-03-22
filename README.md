# 2025-백엔드 챌린지

## 목적

## 기술스택
- php8.0
- laravel 11
- mysql8.0
- docker27.4
- npm 20.0.0

## 목차
### 1. 로그인 / 로그아웃 기능 (2025.01.26 ~ 2025.02.09)
라라벨의 Auth기능을 이용하여 구현

### 2. 소셜 로그인 기능 (카카오/구글연계) (2025.02.10 ~ 2025.02.27)
1. socialite 프로바이저 설치
    ```composer  i socialiteproviders/google```
    ```composer  i　socialiteproviders/kakao```

2. .env파일에 각 플랫폼에서 제공하는 CLIENT_ID / CLIENT_SECRET과 리다이렉트URL을 넣어준다
    ```
    GOOGLE_CLIENT_ID=
    GOOGLE_CLIENT_SECRET=
    GOOGLE_REDIRECT_URL=

    KAKAO_CLIENT_ID=
    KAKAO_CLIENT_SECRET=
    KAKAO_REDIRECT_URL=
    ```

3. app/Providers/AppServiceProvider.php 작성
    ```
    public function boot(): void
        {
            Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
                $event->extendSocialite('google', \SocialiteProviders\Google\Provider::class);
                $event->extendSocialite('kakao', \SocialiteProviders\Kakao\KakaoProvider::class);
            });
        }
    ```
공식문서에 
    ```
        $event->extendSocialite('kakao', \SocialiteProviders\Kakao\Provider::class);
    ```
로 적혀있어서 정말 고생했다^^... **KakaoProvider**로 작성하자....

4. bootstrap/providers.php에 프로바이저 등록
    ```
        return [
            App\Providers\AppServiceProvider::class,
            \SocialiteProviders\Manager\ServiceProvider::class
        ];
    ```
5. users 데이터베이스에 provier / provider_id 칼럼 추가

6. Controller에 Socialite 드라이버 클래스 사용하여 로그인 및 사용자 정보 가져오기
    ```
        // ----------------------
        // Google 로그인
        // ----------------------
        public function redirectToGoogle()
        {
            return Socialite::driver('google')->redirect();
        }

        public function handleGoogleCallback()
        {
            try {
                $socialUser = Socialite::driver('google')->stateless()->user();
                return $this->handleSocialLogin($socialUser, 'google');
            } catch (\Exception $e) {
                return redirect('/login')->with('error', 'Google 로그인 중 오류가 발생했습니다.');
            }
        }

        // ----------------------
        // Kakao 로그인
        // ----------------------
        protected function getTokenUrl()
        {
            return 'https://kauth.kakao.com/oauth/token';
        }
        
        public function redirectToKakao()
        {
            return Socialite::driver('kakao')->redirect();
        }

        public function handleKakaoCallback()
        {
            try {
                $socialUser = Socialite::driver('kakao')->stateless()->user();
                return $this->handleSocialLogin($socialUser, 'kakao');
            } catch (\Exception $e) {
                return redirect('/login')->with('error', 'Kakao 로그인 중 오류가 발생했습니다.');
            }
        }
    ```

### 3. 유저 정보 리스트/ 등록/ 수정 /삭제 기능 비밀번호 변경 기능 (메일로 인증번호 송신하여 인증하기)(2025.02.28 ~ 2025.03.13)

1. 유저정보 crud 블레이드 템플릿 작성

2. 비밀번호 갱신 토큰 테이블(password_reset_tokens)에 token칼럼을 verification_code 칼럼으로 변경  expired_at(인증코드 만료 시간) 칼럼 추가

3. 비밀번호 찾기 페이지 (이메일 입력)
   인증번호 입력 페이지 (인증번호 입력)
   비밀번호 재설정 페이지 (새 비밀번호 / 새 비밀번호 확인 입력)
   blade 템플릿 작성 (views/auth/passwords/**.blade.php)

4. .env 파일 업데이트 (gmail을 사용하여 메일 송신)

    ```
        MAIL_MAILER=smtp
        MAIL_HOST=smtp.gmail.com 
        MAIL_PORT=587
        MAIL_USERNAME= 본인 이메일
        MAIL_PASSWORD="비밀번호"
        MAIL_ENCRYPTION=tls
        MAIL_FROM_ADDRESS= 본인 이메일
    ```

5. Http/Controllers/Auth/PasswordController.php에서 비밀번호 관련 로직 작성

6. 송신 메일에 관한 blade 템플릿 작성 (views/emails/verification_code.blade.php)

7. Mail/VerificationCodeMail.php로 mail 보낼 blade 템플릿 지정


### 4. 좋아요/찜하기 기능 (2025.03.14 ~ 2025.03.28)

1. 상품 테이블 작성 (products)

2. 유저와 상점 유저와 상품을 연관짓는 데이터베이스 작성 (user_likes_products) (user_saved_products)

3. 유저가 상품 좋아요, 찜하기 로직을 수행하는 controller 작성

4. 상품관련 blade 작성 (views/products/)

5. 유저 blade 수정 


## 로컬 환경 실행

1. ``` cd src ```
2. ``` cp .env .env.example ```
3. ``` cd ../ ```
4. ``` . ./init.sh ```
