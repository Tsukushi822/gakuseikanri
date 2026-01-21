<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Grade;
use App\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
    
        if ($request->filled('school_grade')) {
            $query->where('grade', $request->school_grade);
        }
    
        $students = $query->get();
    
        $grades = Student::distinct()->pluck('grade');
    
        return view('students.index', compact('students', 'grades'));
    }
        

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
{
    
    $request->validate([
        'name' => 'required',
        'address' => 'required',
        'photo' => 'nullable|image|max:2048'
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

    return redirect()->route('menu')->with('success','学生を登録しました');
}

    public function show(Request $request,$id)
{
    $student = Student::findOrFail($id);

     $gradesYears = [1, 2, 3, 4];
     if ($request->filled('grade')) {
        $gradesYears = [(int)$request->grade];
    }

     $semesters  = [1, 2, 3];
     if ($request->filled('semester')) {
        $semesters = [(int)$request->semester];
    }

     $subjects   = Subject::all();
 
     $selectedGrade    = $request->grade;
     $selectedSemester = $request->semester;
 
     $grades = Grade::where('student_id', $student->id)->get();
 
     $gradesMap = [];
     foreach ($grades as $grade) {
         $gradesMap[$grade->grade][$grade->semester][$grade->subject_id] = $grade;
     }
 
     return view('students.show', compact(
         'student',
         'subjects',
         'gradesYears',
         'semesters',
         'gradesMap',
         'selectedGrade',
         'selectedSemester'
     ));

}


    public function edit($id)
{
    $student = Student::findOrFail($id);
    return view('students.edit', compact('student'));
}

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'grade' => 'required|integer',
        'address' => 'nullable|string',
        'comment' => 'nullable|string',
        'photo'   => 'nullable|image|max:2048',
    ]);

    $student = Student::findOrFail($id);

    $student->name = $request->name;
    $student->grade = $request->grade;
    $student->address = $request->address;
    $student->comment = $request->comment;

    if ($request->hasFile('photo')) {

        if ($student->img_path) {
            Storage::disk('public')->delete($student->img_path);
        }

        $path = $request->file('photo')->store('photos', 'public');
        $student->img_path = $path;
    }

    $student->save();

    return redirect()->route('students.show', $student->id)
                     ->with('success', '学生情報を更新しました');
}

    public function destroy($id)
{
    $student = Student::findOrFail($id);
    $student->delete();
    return redirect('/')->with('success', '学生を削除しました');
}


public function upgradeGrade()
{
    DB::table('students')
        ->whereNotNull('grade')
        ->update([
            'grade' => DB::raw('grade + 1')
        ]);

    return redirect()
        ->route('menu')
        ->with('success', '全学生の学年を更新しました');

}


}
