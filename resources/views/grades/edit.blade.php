<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>成績編集</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<h1>成績編集</h1>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('grades.update', $grade->id) }}" method="POST">
    @csrf
    @method('PUT')

    <p>
        学生名：<strong>{{ $grade->student->name }}</strong>
    </p>


    <label>学年:</label>
    <select name="grade" required>
        @for ($i = 1; $i <= 4; $i++)
            <option value="{{ $i }}" {{ $grade->grade == $i ? 'selected' : '' }}>
                {{ $i }}年
            </option>
        @endfor
    </select>
    <br>

    <label>学期:</label>
    <select name="semester" required>
        @for ($i = 1; $i <= 3; $i++)
            <option value="{{ $i }}" {{ $grade->semester == $i ? 'selected' : '' }}>
                {{ $i }}学期
            </option>
        @endfor
    </select>
    <br>

    <p>
        科目：<strong>{{ $grade->subject->name }}</strong>
    </p>

    <input type="hidden" name="subject_id" value="{{ $grade->subject_id }}">


    <label>点数:</label>
        <select name="score" required>
        @for ($i = 0; $i <= 100; $i++)
            <option value="{{ $i }}"
                {{ $grade->score == $i ? 'selected' : '' }}>
                {{ $i }}
            </option>
        @endfor
    </select>
    <br>

<a href="{{ route('students.show', $grade->student_id) }}">
    学生詳細に戻る
</a>

</body>
</html>










