<table border="1" style="margin-top: 10px;">
    <tr>
        <th>学年</th>
        <th>名前</th>
        <th>操作</th>
    </tr>
    @forelse ($students as $student)
        <tr>
            <td>{{ $student->grade }}</td>
            <td>{{ $student->name }}</td>
            <td>
                <a href="{{ route('students.show', $student->id) }}">詳細</a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3">該当する学生がいません</td>
        </tr>
    @endforelse
</table>
