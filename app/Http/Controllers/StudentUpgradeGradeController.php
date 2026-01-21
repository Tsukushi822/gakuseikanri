<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;


class StudentUpgradeGradeController extends Controller
{
    public function __invoke(Request $request)
    {
        Student::query()->increment('grade');

        return redirect()
            ->route('students.index')
            ->with('success', '全学生を進級しました');
    }

}
