<?php

namespace App\Http\Controllers;


use App\Student;
use App\Grade;
use App\Subject;
use Illuminate\Http\Request;

class StudentShowController extends Controller
{
    
    public function __invoke($id)
    {
        
        $student = Student::findOrFail($id);

    $grades = Grade::with('subject')
        ->where('student_id', $id)
        ->get();

    $gradeYears = [1, 2, 3];
    $semesters  = [1, 2, 3];
    $subjects   = Subject::orderBy('id')->get();

    $gradesMap = [];
    foreach ($grades as $grade) {
        $gradesMap[$grade->grade][$grade->semester][$grade->subject_id] = $grade;
    }

    return view('students.show', compact(
        'student',
        'gradeYears',
        'semesters',
        'subjects',
        'gradesMap'
    ));
        
    }
}
