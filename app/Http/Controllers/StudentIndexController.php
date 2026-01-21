<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentIndexController extends Controller
{
    
    public function __invoke(Request $request)
    {
        $query = Student::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('school_grade')) {
            $query->where('grade', $request->school_grade);
        }

        $students = $query->get();

        $grades = Student::whereNotNull('grade')
            ->distinct()
            ->orderBy('grade')
            ->pluck('grade');

        return view('students.index', compact('students', 'grades'));
    }
    
}
