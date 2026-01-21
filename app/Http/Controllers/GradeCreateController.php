<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Subject;
use App\Grade;


class GradeCreateController extends Controller
{
    public function __invoke($studentId)
    {
        $student  = Student::findOrFail($studentId);
        $subjects  = Subject::all();

        $grades = Grade::where('student_id', $studentId)
        ->where('grade', request('grade'))
        ->where('semester', request('semester'))
        ->get()
        ->keyBy('subject_id');

        $scoresMap = $grades->pluck('score', 'subject_id');

        return view('grades.create', compact(
            'student',
            'subjects',
            'scoresMap'
        ));

    }

    
}
