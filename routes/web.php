<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ProfileController;
use PHPUnit\Framework\Error\Notice;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/departments', [DepartmentController::class, 'index'])->name('department.index');
Route::get('/departments/create', [DepartmentController::class, 'create'])->name('department.create');
Route::post('/departments', [DepartmentController::class, 'store'])->name('department.store');
Route::get('/departments/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
Route::put('/departments/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
Route::delete('/departments/delete/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');

// Academic Year routes
Route::get('/academic-years/create', [AcademicYearController::class, 'create'])->name('academicyear.create');
Route::post('/academic-years', [AcademicYearController::class, 'store'])->name('academicyear.store');
Route::get('/academic-years', [AcademicYearController::class, 'index'])->name('academicyear.index');
Route::delete('/academic-years/delete{id}', [AcademicYearController::class, 'destroy'])->name('academicyear.destroy');
Route::get('/academic-years/edit/{id}', [AcademicYearController::class, 'edit'])->name('academicyear.edit');
Route::put('/academic-years/update/{id}', [AcademicYearController::class, 'update'])->name('academicyear.update');

Route::get('/users', [UserController::class,'index'])->name('user.index');
Route::get('/users/create', [UserController::class,'create'])->name('user.create');
Route::post('/users', [UserController::class,'store'])->name('user.store');
Route::get('/users/edit/{id}', [UserController::class,'edit'])->name('user.edit');
Route::put('/users/update/{id}', [UserController::class,'update'])->name('user.update');
Route::delete('/users/delete/{id}', [UserController::class,'destroy'])->name('user.destroy');

Route::get('/timetables', [TimetableController::class,'index'])->name('timetable.index');
Route::get('/timetables/create', [TimetableController::class,'create'])->name('timetable.create');
Route::post('/timetables', [TimetableController::class,'store'])->name('timetable.store');
Route::get('/timetables/edit/{id}', [TimetableController::class,'edit'])->name('timetable.edit');
Route::put('/timetables/update/{id}', [TimetableController::class,'update'])->name('timetable.update');
Route::delete('/timetables/delete/{id}', [TimetableController::class,'destroy'])->name('timetable.destroy');

Route::get('/notices', [NoticeController::class,'index'])->name('notices.index');
Route::get('/notices/create', [NoticeController::class,'create'])->name('notices.create');
Route::post('/notices', [NoticeController::class,'store'])->name('notices.store');
Route::get('/notices/edit/{id}', [NoticeController::class,'edit'])->name('notices.edit');
Route::put('/notices/update/{id}', [NoticeController::class,'update'])->name('notices.update');
Route::delete('/notices/delete/{id}', [NoticeController::class,'destroy'])->name('notices.destroy');

Route::get('/assignments', [AssignmentController::class,'index'])->name('assignment.index');
Route::get('/assignments/create', [AssignmentController::class,'create'])->name('assignment.create');
Route::post('/assignments', [AssignmentController::class,'store'])->name('assignment.store');
Route::get('/assignments/edit/{id}', [AssignmentController::class,'edit'])->name('assignment.edit');
Route::put('/assignments/update/{id}', [AssignmentController::class,'update'])->name('assignment.update');
Route::delete('/assignments/delete/{id}', [AssignmentController::class,'destroy'])->name('assignment.destroy');

//Route::get('/profiles', [ProfileController::class,'show'])->name('profiles.show');

Route::get('/profiles', [ProfileController::class, 'show'])->name('profiles.show');
Route::get('/profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
Route::put('/profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');


