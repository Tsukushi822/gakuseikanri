<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grade;
use App\Subject;

class GradeEditController extends Controller
{
    public function __invoke($id)
    {
        $grade = Grade::with('student', 'student')->findOrFail($id);
       
        return view('grades.edit', compact('grade'));
    }

}
