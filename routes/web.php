<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\GradeCreateController;
use App\Http\Controllers\GradeEditController;
use App\Http\Controllers\GradeStoreController;
use App\Http\Controllers\GradeUpdateController;
use App\Http\Controllers\StudentIndexController;
use App\Http\Controllers\StudentShowController;
use App\Http\Controllers\StudentCreateController;
use App\Http\Controllers\StudentStoreController;
use App\Http\Controllers\StudentEditController;
use App\Http\Controllers\StudentUpdateController;
use App\Http\Controllers\StudentDestroyController;
use App\Http\Controllers\StudentGradeUpController;
use App\Http\Controllers\StudentUpgradeGradeController;
use App\Http\Controllers\StudentSearchController;
use App\Http\Controllers\GradeSearchController;




Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/menu', [MenuController::class, 'index'])->name('menu')->middleware('auth');



Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware('auth')->group(function () {

    Route::get('/menu', [MenuController::class, 'index'])
            ->name('menu');
    
    Route::get('/students', StudentIndexController::class)
            ->name('students.index');

    Route::get('/students/search', StudentSearchController::class)
            ->name('students.search');

    
    Route::get('/students/create', StudentCreateController::class)
            ->name('students.create');
    
    Route::post('/students', StudentStoreController::class)
            ->name('students.store');
    
    Route::get('/students/{id}', StudentShowController::class)
            ->name('students.show');
    
    Route::get('/students/{id}/edit', StudentEditController::class)
            ->name('students.edit');
    
    Route::put('/students/{id}', StudentUpdateController::class)
            ->name('students.update');

    Route::delete('/students/{id}', StudentDestroyController::class)
            ->name('students.destroy');

    Route::get('/grades/create/{studentId}', GradeCreateController::class)
            ->name('grades.create');
        
    Route::post('/grades', GradeStoreController::class)
            ->name('grades.store');
        
    Route::get('/grades/{id}/edit', GradeEditController::class)
            ->name('grades.edit');
        
    Route::put('/grades/{id}', GradeUpdateController::class)
            ->name('grades.update');

    Route::post('/students/grade-up', StudentGradeUpController::class)
            ->name('students.gradeUp');
        
    Route::post('/students/upgrade-grade', StudentUpgradeGradeController::class)
            ->name('students.upgradeGrade');

    Route::get('/students/{id}/grades/search',GradeSearchController::class)
        ->name('grades.search');

        
    });




    

