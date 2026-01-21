<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;


class StudentGradeUpController extends Controller
{
    public function __invoke(Student $student)
        {
            $student->increment('grade');
    
            return redirect()
                ->route('students.index')
                ->with('success', '学年を進級しました');
        }
}
    



