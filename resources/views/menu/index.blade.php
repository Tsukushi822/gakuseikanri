<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メニュー画面</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    <h1>メニュー画面</h1>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <ul class="menu">
        <li>
            <a href="{{ route('students.index') }}">
                学生表示
            </a>
        </li>

        <li>
            <a href="{{ route('students.create') }}">
                学生登録
            </a>
        </li>
    </ul>

    <hr>

    <h2>年度更新</h2>

    <form action="{{ route('students.upgradeGrade') }}" method="POST"
          onsubmit="return confirm('全学生の学年を1つ上げます。本当によろしいですか？')">
        @csrf
        <button type="submit" style="color: red;">
            学年更新
        </button>
    </form>

    <hr>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
</body>
</html>

