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
    BlogApiController,
    AuthApiController,
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

Route::post('register',[AuthApiController::class,'register']);
Route::post('login',[AuthApiController::class,'login']);
Route::post('logout',[AuthApiController::class,'logout'])->Middleware('auth:sanctum');

Route::get('users',[UserApiController::class,'users']);
Route::get('users/{id}',[UserApiController::class,'userDetails']);
Route::post('users/update/{id}',[UserApiController::class,'userUpdate'])->Middleware('auth:sanctum');
Route::delete('users/delete/{id}',[UserApiController::class,'userDelete']);
Route::post('/users/create', [UserApiController::class, 'userCreate']);


//Add authentication
Route::middleware('auth:sanctum')->group(function(){

Route::get('/departments', [DepartmentApiController::class, 'departments']);
Route::get('/departments/{id}', [DepartmentApiController::class, 'departmentDetails']);
Route::patch('/departments/update/{id}', [DepartmentApiController::class, 'departmentUpdate']);
Route::delete('/departments/delete/{id}', [DepartmentApiController::class, 'departmentDelete']);
Route::post('/departments/create', [DepartmentApiController::class, 'departmentCreate']);

});

// Departments
// Notices
Route::get('/notices', [NoticeApiController::class, 'notices']);
Route::get('/notices/{id}', [NoticeApiController::class, 'noticeDetails']);
Route::post('/notices/update/{id}', [NoticeApiController::class, 'noticeUpdate']);
Route::delete('/notices/delete/{id}', [NoticeApiController::class, 'noticeDelete']);
Route::post('/notices/create', [NoticeApiController::class, 'noticeCreate']);

// Assignments
Route::get('/assignments', [AssignmentApiController::class, 'assignments']);
Route::get('/assignments/{id}', [AssignmentApiController::class, 'assignmentDetails']);
Route::put('/assignments/update/{id}', [AssignmentApiController::class, 'assignmentUpdate']);
Route::delete('/assignments/delete/{id}', [AssignmentApiController::class, 'assignmentDelete']);
Route::post('/assignments/create', [AssignmentApiController::class, 'assignmentCreate']);

// Academic Years
Route::get('/academic-years', [AcademicYearApiController::class, 'academicYears']);
Route::get('/academic-years/{id}', [AcademicYearApiController::class, 'academicYearDetails']);
Route::put('/academic-years/update/{id}', [AcademicYearApiController::class, 'academicYearUpdate']);
Route::delete('/academic-years/delete/{id}', [AcademicYearApiController::class, 'academicYearDelete']);
Route::post('/academic-years/create', [AcademicYearApiController::class, 'academicYearCreate']);

// TimeTables
Route::get('/timetables', [TimeTableApiController::class, 'timeTables']);
Route::get('/timetables/{id}', [TimeTableApiController::class, 'timeTableDetails']);
Route::put('/timetables/update/{id}', [TimeTableApiController::class, 'timeTableUpdate']);
Route::delete('/timetables/delete/{id}', [TimeTableApiController::class, 'timeTableDelete']);
Route::post('/timetables/create', [TimeTableApiController::class, 'timeTableCreate']);

// Blogs
Route::get('/blogs', [BlogApiController::class, 'blogs']);
Route::get('/blogs/{id}', [BlogApiController::class, 'blogDetails']);
Route::put('/blogs/update/{id}', [BlogApiController::class, 'blogUpdate']);
Route::delete('/blogs/delete/{id}', [BlogApiController::class, 'blogDelete']);
Route::post('/blogs/create', [BlogApiController::class, 'blogCreate']);
