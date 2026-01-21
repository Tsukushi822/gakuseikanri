<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentStoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'address' => 'required',
            'photo'   => 'nullable|image|max:2048',
        ]);

        $student = new Student();
        $student->name = $request->name;
        $student->address = $request->address;

        $student->grade = 1;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $student->img_path = $path;
        }

        $student->save();

        return redirect()
            ->route('menu')
            ->with('success', '学生を登録しました');
    }
}
