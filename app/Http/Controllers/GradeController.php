<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grade;
use App\Student;
use App\Subject;


class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['student', 'subject'])->get();
        return view('grades.index', compact('grades'));
    }


    public function create(Request $request)
{
    $student_id = $request->student_id;

    $student = Student::findOrFail($student_id);

    $subjects = Subject::all();

    return view('grades.create', compact(
        'student_id',
        'student',
        'subjects',
    ));
}



    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade'      => 'required|integer|min:1|max:6',
            'semester'   => 'required|integer|min:1|max:6',
            'score'      => 'required|integer|min:0|max:100',
            
        ]);

        $grade = Grade::create($validated);

        return redirect()
            ->route('students.show', $validated['student_id'])
            ->with('success', '成績を登録しました');
    }

    public function edit($id)
    {
        $grade = Grade::with('student', 'subject')->findOrFail($id);
        $subjects = Subject::all();

        return view('grades.edit', compact('grade', 'subjects'));

    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'grade'      => 'required|integer|min:1',
            'semester'   => 'required|integer|min:1',
            'score'      => 'required|integer|min:0|max:100',
        ]);

        $grade = Grade::findOrFail($id);

        $grade->update([
            'subject_id' => $request->subject_id,
            'grade'      => $request->grade,
            'semester'   => $request->semester,
            'score'      => $request->score,
        ]);


        return redirect()
        ->route('students.show', $grade->student_id)
        ->with('success', '成績を更新しました');
    }
}
