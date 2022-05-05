<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubmissionController;

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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/newUser', [UserController::class, 'create']);
    Route::post('/newCompany', [CompanyController::class, 'create']);
    Route::post('/newCourse', [CourseController::class, 'create']);
    Route::post('/submissionLesson', [SubmissionController::class, 'create']);
    Route::get('getProgress', [ProgressController::class, 'getProgress']);
    Route::post('updateProgress', [ProgressController::class, 'updateProgress']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/searchUser', [UserController::class, 'search']);
    Route::get('/searchCompany', [CompanyController::class, 'search']);
    Route::get('/searchCourse', [CourseController::class, 'search']);
    Route::get('/searchSubmission', [SubmissionController::class, 'search']);
    Route::get('/getUsers', [UserController::class, 'all']);
    Route::get('/getCompanies', [CompanyController::class, 'all']);
    Route::get('/getCourses', [CourseController::class, 'all']);
    Route::get('/getCategories', [ContentController::class, 'getAllCategory']);
    Route::get('/getCourseInfo', [CourseController::class, 'getCourseInfo']);
});

Route::post('/login', [UserController::class, 'login']);
Route::get('/searchContent', [ContentController::class, 'search']);
