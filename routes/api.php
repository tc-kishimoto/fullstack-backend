<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\NotificationController;

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
    Route::post('/user', [UserController::class, 'create']);
    Route::post('/company', [CompanyController::class, 'create']);
    Route::post('/course', [CourseController::class, 'create']);
    Route::post('/submissionLesson', [SubmissionController::class, 'create']);
    Route::get('/progress', [ProgressController::class, 'getProgress']);
    Route::put('/progress', [ProgressController::class, 'updateProgress']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/searchUser', [UserController::class, 'search']);
    Route::get('/searchCompany', [CompanyController::class, 'search']);
    Route::get('/filterCompany', [CompanyController::class, 'filter']);
    Route::get('/filterCourse', [CourseController::class, 'filter']);
    Route::get('/filterUser', [UserController::class, 'filter']);
    Route::get('/searchCourse', [CourseController::class, 'search']);
    Route::get('/searchSubmission', [SubmissionController::class, 'search']);
    Route::get('/searchNotification', [NotificationController::class, 'search']);
    Route::get('/getUsers', [UserController::class, 'all']);
    Route::get('/getCompanies', [CompanyController::class, 'all']);
    Route::get('/getCourses', [CourseController::class, 'all']);
    Route::get('/getCategories', [ContentController::class, 'getAllCategory']);
    Route::get('/getUnits', [ContentController::class, 'getCategoryUnit']);
    Route::get('/getCourseInfo', [CourseController::class, 'getCourseInfo']);
    Route::get('/getCourse/{id}', [CourseController::class, 'getCourseById']);
    Route::get('/getAddInCourseTargetUser', [UserController::class, 'getAddInCourseTargetUser']);
    Route::post('addUserInCourse', [CourseController::class, 'addUser']);
    Route::get('/user', [UserController::class, 'getUser']);
    Route::get('/getUser/{id}', [UserController::class, 'getUserById']);
    Route::get('/course', [CourseController::class, 'getCourse']);
    Route::get('/company', [CompanyController::class, 'getCompany']);
    Route::get('/getCompany/{id}', [CompanyController::class, 'getCompanyById']);
    Route::put('/user', [UserController::class, 'update']);
    Route::put('/course', [CourseController::class, 'update']);
    Route::put('/company', [CompanyController::class, 'update']);
    Route::delete('/user', [UserController::class, 'delete']);
    Route::delete('/user/{id}', [UserController::class, 'deleteById']);
    Route::delete('/course', [CourseController::class, 'delete']);
    Route::delete('/course/{id}', [CourseController::class, 'deleteById']);
    Route::delete('/company', [CompanyController::class, 'delete']);
    Route::delete('/company/{id}', [CompanyController::class, 'deleteById']);
    Route::get('/submission', [SubmissionController::class, 'getSubmission']);
    Route::put('/submission', [SubmissionController::class, 'update']);
    Route::delete('/submission', [SubmissionController::class, 'delete']);
    Route::get('/getSubmissions', [SubmissionController::class, 'getSubmissions']);
    Route::put('/password', [UserController::class, 'updatePassword']);
    Route::get('/getAchivement', [ProgressController::class, 'getAchivement']);
    Route::get('/getCategoryProgress', [ProgressController::class, 'getCategoryProgress']);
    Route::get('/getCompanyUsers', [UserController::class, 'getCompanyUsers']);
    Route::get('/getCompanyUsers/{id}', [UserController::class, 'filterCompanyUsers']);
    Route::get('/getDiplayContents', [DisplayController::class, 'getDiplayContents']);
    Route::post('/updateDisplayFlag', [DisplayController::class, 'updateDisplayFlag']);
    Route::get('/getNotification', [NotificationController::class, 'getNotification']);
    Route::put('/notificationStatus', [NotificationController::class, 'updateNotificationStatus']);
    Route::post('/addSubmissionComment', [SubmissionController::class, 'addComment']);
    Route::get('/getSubmissionCommentList', [SubmissionController::class, 'getCommentList']);
    Route::delete('/submissionComment', [SubmissionController::class, 'commentDelete']);
    Route::put('/submissionComment', [SubmissionController::class, 'commentUpdate']);
    Route::get('/getMySubmissions', [SubmissionController::class, 'getMySubmissions']);
    Route::get('getSubmission/{id}', [SubmissionController::class, 'find']);
});

Route::post('/login', [UserController::class, 'login']);
Route::get('/searchContent', [ContentController::class, 'search']);
