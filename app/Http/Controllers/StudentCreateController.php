<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentCreateController extends Controller
{
   
    public function __invoke()
    {
        return view('students.create');
    }

}
