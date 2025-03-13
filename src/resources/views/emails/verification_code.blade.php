<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>비밀번호 재설정 인증번호</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            padding: 30px;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        .code {
            font-size: 24px;
            font-weight: bold;
            color: #2d89ef;
            margin: 20px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>비밀번호 재설정 요청</h2>
        <p>아래 인증번호를 입력하여 비밀번호 재설정을 진행하세요.</p>

        <p class="code">{{ $verificationCode }}</p>

        <p>인증번호는 5분 후 만료됩니다.</p>

        <div class="footer">
            <p>이 메일을 요청하지 않았다면 무시해 주세요.</p>
        </div>
    </div>
</body>
</html>
