<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student;
use App\Subject;

class Grade extends Model
{
    protected $fillable = [
        'student_id',
        'subject_id',
        'grade',
        'semester',
        'score',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
