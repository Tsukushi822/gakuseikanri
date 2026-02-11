<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentSearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $name        = $request->name;
        $schoolGrade = $request->school_grade;
        $sort        = $request->sort;

        $students = Student::query()
            ->when($name, function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            })
            ->when($schoolGrade, function ($query) use ($schoolGrade) {
                $query->where('grade', $schoolGrade);
            })
            ->when($sort, function ($query) use ($sort) {
                $query->orderBy('grade', $sort); 
            })
            ->get();

        return view('students.partials.list', compact('students'));
    }
}
