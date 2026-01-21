<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>学生編集</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    <h1>学生編集</h1>

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>ID：</label>
            <span>{{ $student->id }}</span>
        </div>

        <div>
            <label>名前：</label>
            <input type="text" name="name" value="{{ old('name', $student->name) }}" required>
        </div>

        <div>
            <label>学年：</label>
            <input type="number" name="grade" value="{{ old('grade', $student->grade) }}" required>
        </div>

        <div>
            <label>住所：</label>
            <input type="text" name="address" value="{{ old('address', $student->address) }}">
        </div>

        <div>
            <label>現在の顔写真：</label><br>
            @if ($student->img_path)
                <img src="{{ asset('storage/' . $student->img_path) }}"
                     width="120">
            @else
             なし
         @endif
        </div>

         <div>
            <label>顔写真を変更：</label>
            <input type="file" name="photo">
         </div>

        <div>
            <label>コメント：</label>
            <textarea name="comment">{{ old('comment', $student->comment) }}</textarea>
        </div>

        <button type="submit">更新</button>
    </form>

    <a href="{{ route('students.show', $student->id) }}">戻る</a>
</body>
</html>
