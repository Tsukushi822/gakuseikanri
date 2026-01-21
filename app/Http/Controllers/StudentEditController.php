<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentEditController extends Controller
{

    public function __invoke($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }
}
