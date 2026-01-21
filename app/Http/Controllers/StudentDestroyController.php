<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentDestroyController extends Controller
{
    public function __invoke($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', '学生を削除しました');
    }
}
