<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grade;

class GradeStoreController extends Controller
{
    public function __invoke(Request $request)
{
    $request->validate([
        'student_id' => 'required',
        'grade' => 'required|integer',
        'semester'   => 'required|integer',
        'scores'     => 'nullable|array',
    ]);

    foreach ($request->scores as $subjectId => $score) {
        if ($score === null || $score === '') {
            continue;
        }

        Grade::updateOrCreate(
            [
                'student_id' => $request->student_id,
                'subject_id' => $subjectId,
                'grade' => $request->grade,
                'semester'   => $request->semester,
            ],
            [
                'score' => $score,
            ]
        );
    }

    return redirect()
        ->route('students.show', $request->student_id)
        ->with('success', '成績を登録しました');
}

}
