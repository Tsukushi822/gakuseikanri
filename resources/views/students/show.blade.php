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

        <form id="grade-search-form" >
            <input type="hidden" name="student_id" value="{{ $student->id }}">

            <label>学年：
                <select name="grade_year">
                    <option value="">すべて</option>
                    <option value="1">1年</option>
                    <option value="2">2年</option>
                    <option value="3">3年</option>
                </select>
            </label>

            <label>学期：
                <select name="semester">
                    <option value="">すべて</option>
                    <option value="1">1学期</option>
                    <option value="2">2学期</option>
                    <option value="3">3学期</option>

                </select>
            </label>

            <button type="submit">検索</button>
        </form>


<hr>

<h2>成績一覧</h2>

<div id="grade-list" data-student-id="{{ $student->id }}">
@include('grades.partials.matrix')
</div>

<script>
document.getElementById('grade-search-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = this;
    const params = new URLSearchParams(new FormData(form));

    const studentId = document
        .getElementById('grade-list')
        .dataset.studentId;

    fetch(`/students/${studentId}/grades/search?` + params.toString())
        .then(response => response.text())
        .then(html => {
            document.getElementById('grade-list').innerHTML = html;
        });
});
</script>


</body>
</html>
