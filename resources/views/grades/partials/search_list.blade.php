<table border="1" cellpadding="5">
    <tr>
        <th>学年</th>
        <th>学期</th>
        <th>科目</th>
        <th>点数</th>
        <th>編集</th>
    </tr>

    @forelse ($grades as $grade)
        <tr>
            <td>{{ $grade->grade }}年</td>
            <td>{{ $grade->semester }}学期</td>
            <td>{{ $grade->subject->name }}</td>
            <td>{{ $grade->score }}</td>
            <td>
                <a href="{{ route('grades.edit', $grade->id) }}">成績編集</a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5">該当する成績はありません</td>
        </tr>
    @endforelse
</table>
