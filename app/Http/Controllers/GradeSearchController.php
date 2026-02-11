<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grade;
use App\Subject;

class GradeSearchController extends Controller
{

    public function __invoke(Request $request, $id)
    {

        $gradesQuery = Grade::with('subject')
            ->where('student_id', $id);

        if ($request->filled('grade_year')) {
            $gradesQuery->where('grade', $request->grade_year);
        }

        if ($request->filled('semester')) {
            $gradesQuery->where('semester', $request->semester);
        }

        $grades = $gradesQuery->get();

        $gradeYears = $grades->pluck('grade')->unique()->sort();
        $semesters  = $grades->pluck('semester')->unique()->sort();
        $subjects   = Subject::orderBy('id')->get();

        $gradesMap = [];
        foreach ($grades as $grade) {
            $gradesMap[$grade->grade][$grade->semester][$grade->subject_id] = $grade;
        }

        return view('grades.partials.matrix', compact(
            'gradeYears',
            'semesters',
            'subjects',
            'gradesMap'
        ));
    
    }
    

}
