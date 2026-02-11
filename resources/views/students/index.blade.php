@extends('layouts.app')

@section('content')
<h2>学生表示画面</h2>

<form id="search-form">
    <label>学生名：
        <input type="text" name="name">
    </label>

    <label>学年：
        <select name="school_grade">
            <option value="">すべて</option>
            @foreach($grades as $grade)
                <option value="{{ $grade }}">{{ $grade }}</option>
            @endforeach
        </select>
    </label>

    <label>学年順：
        <select name="sort">
            <option value="">指定なし</option>
            <option value="asc">昇順</option>
            <option value="desc">降順</option>
        </select>
    </label>

    <button type="submit">検索</button>
</form>

<hr>

<div id="student-list">
    @include('students.partials.list', ['students' => $students])
</div>

<br>
<a href="{{ route('menu') }}">← メニュー画面へ戻る</a>

<script>
const form = document.getElementById('search-form');

form.addEventListener('submit', fetchStudents);
form.querySelector('[name="sort"]').addEventListener('change', fetchStudents);

function fetchStudents(e) {
    if (e) e.preventDefault();

    const params = new URLSearchParams(new FormData(form));

    fetch(`/students/search?` + params.toString(),{
        headers: {
        'X-Requested-With': 'XMLHttpRequest'
    }
    })
        .then(response => response.text())
        .then(html => {
            document.getElementById('student-list').innerHTML = html;
        });
    }
</script>

@endsection
