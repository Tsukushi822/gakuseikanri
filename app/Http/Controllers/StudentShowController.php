<?php

namespace App\Http\Controllers;


use App\Student;
use App\Grade;
use App\Subject;
use Illuminate\Http\Request;

class StudentShowController extends Controller
{
    
    public function __invoke(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $gradesYears = [1, 2, 3, 4];
        if ($request->filled('grade')) {
            $gradesYears = [(int)$request->grade];
        }

        $semesters = [1, 2, 3];
        if ($request->filled('semester')) {
            $semesters = [(int)$request->semester];
        }

        $subjects = Subject::all();

        $grades = Grade::where('student_id', $student->id)->get();

        $gradesMap = [];
        foreach ($grades as $grade) {
            $gradesMap[$grade->grade][$grade->semester][$grade->subject_id] = $grade;
        }

        return view('students.show', compact(
            'student',
            'subjects',
            'gradesYears',
            'semesters',
            'gradesMap'
        ));
    }
}
