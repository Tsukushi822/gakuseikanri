<table border="1" cellpadding="5">
    <tr>
        <th>学年</th>
        <th>学期</th>
        <th>科目</th>
        <th>点数</th>
        <th>編集</th>
    </tr>

    @foreach ($gradeYears as $gradeYear)
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
                            <a href="{{ route('grades.edit', $grade->id) }}">成績編集</a>
                        @else
                            ―
                        @endif
                    </td>
                </tr>

            @endforeach
        @endforeach
    @endforeach
</table>


