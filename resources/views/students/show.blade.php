<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>学生詳細</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    <h1>学生詳細</h1>

    <table border="1" cellpadding="10">
        <tr>
            <th>学年</th>
            <td>{{ $student->grade }}</td>
        </tr>
        <tr>
            <th>名前</th>
            <td>{{ $student->name }}</td>
        </tr>
        <tr>
            <th>住所</th>
            <td>{{ $student->address }}</td>
        </tr>
        <tr>
            <th>顔写真</th>
            <td>
                @if ($student->img_path)
                    <img src="{{ asset('storage/' . $student->img_path) }}" alt="顔写真" width="150">
                @else
                    なし
                @endif
            </td>
        </tr>
        <tr>
            <th>コメント</th>
            <td>{{ $student->comment ?? 'なし' }}</td>
        </tr>
    </table>

    <br>

    <a href="{{ route('students.edit', $student->id) }}">学生編集</a> |
    <a href="{{ route('grades.create', ['studentId' => $student->id]) }}" class="btn btn-primary">
    成績を追加する
</a>|

    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
    </form> |
    <a href="{{ route('students.index') }}">一覧に戻る</a>


    <hr>

    <h2>成績検索</h2>

<form method="GET" action="{{ route('students.show', $student->id) }}">
    <label>学年：</label>
    <select name="grade">
        <option value="">-- 全学年 --</option>
        <option value="1" {{ request('grade') == 1 ? 'selected' : '' }}>1年</option>
        <option value="2" {{ request('grade') == 2 ? 'selected' : '' }}>2年</option>
        <option value="3" {{ request('grade') == 3 ? 'selected' : '' }}>3年</option>
        <option value="4" {{ request('grade') == 4 ? 'selected' : '' }}>4年</option>
    </select>

    <label>学期：</label>
    <select name="semester">
        <option value="">-- 全学期 --</option>
        <option value="1" {{ request('semester') == 1 ? 'selected' : '' }}>1学期</option>
        <option value="2" {{ request('semester') == 2 ? 'selected' : '' }}>2学期</option>
        <option value="3" {{ request('semester') == 3 ? 'selected' : '' }}>3学期</option>
    </select>

    <button type="submit">検索</button>
</form>

<hr>

<h2>成績一覧</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>学年</th>
        <th>学期</th>
        <th>科目</th>
        <th>点数</th>
        <th>編集</th>
    </tr>

        @foreach ($gradesYears as $gradeYear)
        @foreach ($semesters as $semester)
            @foreach ($subjects as $subject)
                @php
                    $grade = $gradesMap[$gradeYear][$semester][$subject->id] ?? null;
                @endphp
                <tr>
                    <td>{{ $gradeYear }}年</td>
                    <td>{{ $semester }}学期</td>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $grade->score ?? '―' }}</td>
                    <td>
                        @if ($grade)
                        <a href="{{ route('grades.edit', $grade->id) }}">
                                成績編集
                            </a>
                        @else
                            ―
                        @endif
                    </td>
                </tr>
            @endforeach
        @endforeach
    @endforeach
    </table>


</body>
</html>
