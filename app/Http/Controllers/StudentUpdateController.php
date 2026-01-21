<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentUpdateController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'grade' => 'required|integer',
            'address' => 'nullable|string',
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->only(['name', 'grade', 'address']));

        return redirect()
            ->route('students.show', $student->id)
            ->with('success', '学生情報を更新しました');
    }
}
