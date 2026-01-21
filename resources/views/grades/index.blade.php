@extends('layouts.app')

@section('content')

    <h2>成績一覧</h2>
    <a href="{{ route('grades.create') }}" class="btn btn-primary">新規登録</a>


    <table border="1">
        <tr>
            <th>ID</th>
            <th>学生名</th>
            <th>科目名</th>
            <th>学期</th>
            <th>点数</th>
        </tr>
        @foreach ($grades as $grade)
            <tr>
                <td>{{ $grade->id }}</td>
                <td>{{ $grade->student->name }}</td>
                <td>{{ $grade->subject->name }}</td>
                <td>{{ $grade->semester }}</td>
                <td>{{ $grade->score }}</td>
                <td>
                <a href="{{ route('grades.edit', $grade->id) }}">編集</a>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>
