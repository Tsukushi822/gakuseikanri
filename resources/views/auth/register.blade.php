<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規登録</title>
</head>
<body>
    <h1>新規登録画面</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.post') }}" method="POST">
        @csrf
        <div>
            <label>名前:</label>
            <input type="text" name="user_name" required>
        </div>

        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label>パスワード:</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <label>パスワード（確認）:</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <button type="submit">登録</button>
    </form>

    <p>すでにアカウントをお持ちの場合は <a href="{{ route('login') }}">ログイン</a></p>
</body>
</html>

