<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>学生登録</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    <h1>学生登録</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>名前：</label>
            <input type="text" name="name" value="{{ old('name') }}">
        </div>

        <div>
            <label>住所：</label>
            <input type="text" name="address" value="{{ old('address') }}">
        </div>

        <div>
            <label>顔写真：</label>
            <input type="file" name="photo">
        </div>

        <div>
            <button type="submit">登録</button>
        </div>
    </form>

    <p><a href="{{ route('menu') }}">メニュー画面に戻る</a></p>
</body>
</html>
