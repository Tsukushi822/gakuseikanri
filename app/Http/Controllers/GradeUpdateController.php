<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grade;

class GradeUpdateController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $request->validate([
            'grade' => 'required|integer',
            'semester'   => 'required|integer',
            'subject_id' => 'required',
            'score'      => 'required|integer|min:0|max:100',
        ]);

        $grade = Grade::findOrFail($id);
        $grade->update($request->only([
        'grade',
        'semester',
        'subject_id',
        'score'
        ]));

        return redirect()
            ->route('students.show', $grade->student_id)
            ->with('success', '成績を更新しました');
    }
}
