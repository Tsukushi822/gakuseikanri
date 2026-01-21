<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>成績新規登録</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    <h1>成績新規登録</h1>

    @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <form action="{{ route('grades.store') }}" method="POST">
    @csrf

    <input type="hidden" name="student_id" value="{{ $student->id }}">

    <p>学生: {{ $student->name }}</p>

    <label>学年:</label>
    <select name="grade" required>
        @for ($i = 1; $i <= 4; $i++)
            <option value="{{ $i }}">{{ $i }}年</option>
        @endfor
    </select><br>

    <label>学期:</label>
    <select name="semester" required>
        <option value="1">1学期</option>
        <option value="2">2学期</option>
        <option value="3">3学期</option>
    </select><br>

        <table border="1" cellpadding="5">
        <tr>
            <th>科目</th>
            <th>点数</th>
        </tr>

        @foreach ($subjects as $subject)
        <tr>
            <td>{{ $subject->name }}</td>
            <td>
                <select name="scores[{{ $subject->id }}]">
                    <option value="">―</option>
                    @for ($i = 0; $i <= 100; $i++)
                        <option value="{{ $i }}"
                        {{ (isset($scoresMap[$subject->id]) && $scoresMap[$subject->id] == $i) ? 'selected' : '' }}>
                        {{ $i }}
                        </option>
                    @endfor
                </select>
            </td>
        </tr>
        @endforeach
    </table>

    <br>
    <button type="submit">登録</button>
    </form>

    <a href="{{ route('students.show', $student->id) }}">
        学生詳細に戻る
    </a>

</body>
</html>
