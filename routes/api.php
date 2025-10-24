<?php

use App\Http\Controllers\Api\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    DepartmentApiController,
    NoticeApiController,
    AssignmentApiController,
    AcademicYearApiController,
    TimeTableApiController,
    BlogApiController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users',[UserApiController::class,'users']);
Route::get('users/{id}',[UserApiController::class,'userDetails']);
Route::put('users/{id}',[UserApiController::class,'userUpdate']);
Route::delete('users/{id}',[UserApiController::class,'userDelete']);


// Departments
Route::get('/departments', [DepartmentApiController::class, 'departments']);
Route::get('/departments/{id}', [DepartmentApiController::class, 'departmentDetails']);
Route::put('/departments/{id}', [DepartmentApiController::class, 'departmentUpdate']);
Route::delete('/departments/{id}', [DepartmentApiController::class, 'departmentDelete']);

// Notices
Route::get('/notices', [NoticeApiController::class, 'notices']);
Route::get('/notices/{id}', [NoticeApiController::class, 'noticeDetails']);
Route::put('/notices/{id}', [NoticeApiController::class, 'noticeUpdate']);
Route::delete('/notices/{id}', [NoticeApiController::class, 'noticeDelete']);

// Assignments
Route::get('/assignments', [AssignmentApiController::class, 'assignments']);
Route::get('/assignments/{id}', [AssignmentApiController::class, 'assignmentDetails']);
Route::put('/assignments/{id}', [AssignmentApiController::class, 'assignmentUpdate']);
Route::delete('/assignments/{id}', [AssignmentApiController::class, 'assignmentDelete']);

// Academic Years
Route::get('/academic-years', [AcademicYearApiController::class, 'academicYears']);
Route::get('/academic-years/{id}', [AcademicYearApiController::class, 'academicYearDetails']);
Route::put('/academic-years/{id}', [AcademicYearApiController::class, 'academicYearUpdate']);
Route::delete('/academic-years/{id}', [AcademicYearApiController::class, 'academicYearDelete']);

// TimeTables
Route::get('/timetables', [TimeTableApiController::class, 'timeTables']);
Route::get('/timetables/{id}', [TimeTableApiController::class, 'timeTableDetails']);
Route::put('/timetables/{id}', [TimeTableApiController::class, 'timeTableUpdate']);
Route::delete('/timetables/{id}', [TimeTableApiController::class, 'timeTableDelete']);

// Blogs
Route::get('/blogs', [BlogApiController::class, 'blogs']);
Route::get('/blogs/{id}', [BlogApiController::class, 'blogDetails']);
Route::put('/blogs/{id}', [BlogApiController::class, 'blogUpdate']);
Route::delete('/blogs/{id}', [BlogApiController::class, 'blogDelete']);
