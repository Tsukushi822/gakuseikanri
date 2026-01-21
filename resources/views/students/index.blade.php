@extends('layouts.app')

@section('content')
    <h2>学生表示画面</h2>


    <form method="GET" action="{{ route('students.index') }}">
        <label>学生名：
            <input type="text" name="name" value="{{ request('name') }}">
        </label>

        <label>学年：
            <select name="school_grade">
                <option value="">すべて</option>
                @foreach($grades as $grade)
                    <option value="{{ $grade }}" {{ request('school_grade') == $grade ? 'selected' : '' }}>
                        {{ $grade }}
                    </option>
                @endforeach
            </select>
        </label>

        <button type="submit">検索</button>
    </form>


    <table border="1" style="margin-top: 10px;">
        <tr>
            <th>学年</th>
            <th>名前</th>
            <th>操作</th>
        </tr>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->grade }}</td>
                <td>{{ $student->name }}</td>
                <td>
                    <a href="{{ route('students.show', $student->id) }}">詳細</a>
                </td>
            </tr>
        @endforeach
    </table>


    <br>
    <a href="{{ route('menu') }}">← メニュー画面へ戻る</a>
@endsection
