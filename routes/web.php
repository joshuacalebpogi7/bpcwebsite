<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ForumsController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('add-to-log', 'HomeController@myTestAddToLog');
Route::get('logActivity', 'HomeController@logActivity');

// Route::middleware('guest')->group(function () {

//USER GET related routes
Route::get('/', [PageController::class, "home"])->name('home');
Route::get('/news', [PageController::class, "news"])->middleware('restrictAdmin');
Route::get('/events', [PageController::class, "events"])->middleware('restrictAdmin');
Route::get('/jobs', [PageController::class, "jobs"])->middleware('authUser');
Route::get('/survey', [PageController::class, "survey"])->middleware('mustBeLoggedIn');
Route::get('/forums', [PageController::class, "forums"])->middleware('restrictAdmin');
Route::get('/gallery', [PageController::class, "gallery"])->middleware('restrictAdmin');
Route::get('/login', [PageController::class, "login"])->name('login')->middleware('guest');


Route::get('/survey_first_time', [PageController::class, "surveyFirstTime"])->middleware('checkAuthRequirements');
Route::get('/additional-info', [PageController::class, "addInfo"])->middleware('checkAuthRequirements');
Route::get('/edit-profile', [PageController::class, "editProfile"])->middleware('authUser');

Route::get('/jobs/{jobs:job_title}', [PageController::class, "jobsSinglePage"])->middleware('authUser');
Route::get('/events/{events:title}', [PageController::class, "eventsSinglePage"])->middleware('authUser');
Route::get('/news/{news:title}', [PageController::class, "newsSinglePage"])->middleware('authUser');
Route::get('/gallery/{album:album_name}', [PageController::class, "gallerySinglePage"])->middleware('authUser');

//User POST related routes
Route::post('/login', [UserController::class, "login"])->middleware('guest');
Route::post('/logout', [UserController::class, "logout"])->middleware('mustBeLoggedIn');
Route::post('/submit-survey', [UserController::class, "submitSurvey"])->middleware('mustBeLoggedIn');
Route::post('/submit-application/{jobs:id}', [UserController::class, "submitApplication"])->middleware('authUser');


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth', 'emailNotVerified')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');

})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('resent', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/forgot-password', [PageController::class, "forgotPassword"])->middleware('guest');
Route::post('/submit-forgot-password', [UserController::class, "submitForgotPassword"])->middleware('guest');

Route::post('/password/forgot', [UserController::class, 'sendResetLink'])->name('forgot.password.link');
Route::get('/password/reset/{token}', [UserController::class, 'showResetForm'])->name('reset.password.form');
Route::post('/password/reset', [UserController::class, 'resetPassword'])->name('reset.password');

//Admin GET related routes
Route::get('/admin/dashboard', [PageController::class, 'adminDashboard'])->middleware('can:visitAdminPages', 'verified');
Route::get('admin/users', [PageController::class, 'adminUsers'])->middleware('can:adminOnly');
Route::get('admin/courses', [PageController::class, 'adminCourses'])->middleware('can:adminOnly');
Route::get('admin/surveys', [PageController::class, 'adminSurvey'])->middleware('can:visitAdminPages');
Route::get('admin/news', [PageController::class, 'adminNews'])->middleware('can:visitAdminPages');
Route::get('admin/events', [PageController::class, 'adminEvents'])->middleware('can:visitAdminPages');
Route::get('admin/gallery', [PageController::class, 'adminGallery'])->middleware('can:visitAdminPages');
Route::get('admin/jobs', [PageController::class, 'adminJobs'])->middleware('can:visitAdminPages');
Route::get('admin/forums', [PageController::class, 'adminForums'])->middleware('can:visitAdminPages');
Route::get('admin/analytics', [PageController::class, "adminAnalytics"])->middleware('can:visitAdminPages');
Route::get('admin/admins', [PageController::class, "adminAdmins"])->middleware('can:adminOnly');
//profile
Route::get('admin/edit-profile', [PageController::class, "editAdminProfile"])->middleware('can:visitAdminPages');
//ADD
Route::get('admin/add-admin', [PageController::class, 'addAdminPage'])->middleware('can:adminOnly');
Route::get('admin/add-alumni', [PageController::class, 'addAlumniPage'])->middleware('can:adminOnly');
Route::get('admin/add-courses', [PageController::class, 'addCoursesPage'])->middleware('can:adminOnly');
Route::get('admin/add-news', [PageController::class, 'addNewsPage'])->middleware('can:visitAdminPages');
Route::get('admin/add-events', [PageController::class, 'addEventsPage'])->middleware('can:visitAdminPages');
Route::get('admin/add-jobs', [PageController::class, 'addJobsPage'])->middleware('can:visitAdminPages');
Route::get('admin/add-gallery', [PageController::class, 'addGalleryPage'])->middleware('can:visitAdminPages');
Route::get('admin/add-forum', [PageController::class, 'addForumPage'])->middleware('can:visitAdminPages');
Route::get('admin/add-survey', [PageController::class, 'addSurveyPage'])->middleware('can:visitAdminPages');
//EDIT
Route::get('admin/edit-alumni/{user:username}', [PageController::class, 'editAlumniPage'])->middleware('can:adminOnly');
Route::get('admin/edit-courses/{course:course}', [PageController::class, 'editCoursesPage'])->middleware('can:adminOnly');
Route::get('admin/edit-admin/{user:username}', [PageController::class, 'editAdminPage'])->middleware('can:adminOnly');
Route::get('admin/edit-news/{news:id}/{title}', [PageController::class, 'editNewsPage'])->middleware('can:visitAdminPages');
Route::get('admin/edit-events/{events:id}/{title}', [PageController::class, 'editEventsPage'])->middleware('can:visitAdminPages');
Route::get('admin/edit-jobs/{jobs:id}/{title}', [PageController::class, 'editJobsPage'])->middleware('can:visitAdminPages');
Route::get('admin/edit-album/{album:id}/{album_name}', [PageController::class, 'editGalleryPage'])->middleware('can:visitAdminPages');


//Admin POST related routes
Route::post('admin/add-news', [NewsController::class, 'addNews'])->middleware('can:visitAdminPages');
Route::post('admin/add-events', [EventsController::class, 'addEvents'])->middleware('can:visitAdminPages');
Route::post('admin/add-jobs', [JobsController::class, 'addJobs'])->middleware('can:visitAdminPages');
Route::post('admin/add-courses', [CourseController::class, 'addCourse'])->middleware('can:visitAdminPages');
Route::post('/admin/add-forum-comment', [ForumsController::class, 'addForumComment'])->middleware('can:visitAdminPages');
Route::post('/admin/add-forum-vote', [ForumsController::class, 'addForumVote'])->middleware('can:visitAdminPages');

Route::post('/import', [AdminController::class, 'import'])->middleware('can:visitAdminPages');
Route::post('/import-courses', [AdminController::class, 'importCourses'])->middleware('can:visitAdminPages');

//Admin UPDATE related routes
Route::put('admin/update-news/{news:id}', [NewsController::class, 'updateNews'])->middleware('can:visitAdminPages');
Route::put('admin/update-events/{events:id}', [EventsController::class, 'updateEvents'])->middleware('can:visitAdminPages');
Route::put('admin/update-jobs/{jobs:id}', [JobsController::class, 'updateJobs'])->middleware('can:visitAdminPages');
Route::put('admin/update-courses/{course:id}', [CourseController::class, 'updateCourse'])->middleware('can:visitAdminPages');

//Admin DELETE related routes
Route::delete('admin/delete-alumni/{user:username}', [AdminController::class, 'deleteUser'])->middleware(['can:adminOnly']);
Route::delete('admin/delete-admin/{user:username}', [AdminController::class, 'deleteUser'])->middleware(['can:adminOnly']);
Route::delete('admin/delete-news/{news:id}', [NewsController::class, 'deleteNews'])->middleware('can:visitAdminPages');
Route::delete('admin/delete-events/{events:id}', [EventsController::class, 'deleteEvents'])->middleware('can:visitAdminPages');
Route::delete('admin/delete-jobs/{jobs:id}', [JobsController::class, 'deleteJobs'])->middleware('can:visitAdminPages');
Route::delete('admin/delete-album/{galleryAlbum:id}', [GalleryController::class, 'deleteAlbum'])->middleware('can:visitAdminPages');
Route::delete('admin/delete-photo/{gallery:id}', [GalleryController::class, 'deletePhoto'])->middleware('can:visitAdminPages');
Route::delete('admin/delete-course/{course:id}', [CourseController::class, 'deleteCourse'])->middleware('can:visitAdminPages');

//Admin VIEW related routes
Route::get('admin/view_forum/{forum_selected}', [PageController::class, 'adminViewForum'])->middleware('can:visitAdminPages')->name('admin/view_forum');
Route::get('admin/reply_forum/{forum_reply_selected}', [PageController::class, 'adminReplyForum'])->middleware('can:visitAdminPages')->name('admin/reply_forum');

/* ROUTE FOR SURVEY */
Route::get('admin/new_survey', function () {
    return view('admin.new_survey');
})->middleware('can:visitAdminPages');
Route::get('admin/edit_survey/{survey_selected}', [SurveyController::class, 'fetchSurveyToBeEdited'])->name('edit_survey')->middleware('can:visitAdminPages');
Route::get('delete_survey/{survey_selected}', [SurveyController::class, 'deleteSurvey'])->name('delete_survey')->middleware('can:visitAdminPages');
/* Route::get('/survey', function () {
    return view('auth.survey');
})->name('survey'); */

Route::get('/answer_survey/{survey_selected}', [SurveyController::class, 'fetchSurveyToBeAnswered'])->middleware('mustBeLoggedIn')->name('answer_survey');
/* ROUTE FOR SURVEY */

/* ROUTE FOR FORUMS */
Route::get('/new_forum', function () {
    return view('auth.new_forum');
})->middleware('mustBeLoggedIn');

Route::get('/forum_post', function () {
    return view('forum_post');
});

Route::get('/posted_forums', function () {
    return view('auth.posted_forums');
})->middleware('mustBeLoggedIn')->name('posted_forums');

Route::get('/view_forum/{forum_selected}', [ForumsController::class, 'viewForum'])->middleware('mustBeLoggedIn')->name('view_forum');
Route::get('/delete_forum/{forum_selected}', [ForumsController::class, 'deleteForum'])->middleware('mustBeLoggedIn')->name('delete_forum');

Route::post('/vote/{parentForum}/{parentReply}', [ForumsController::class, 'vote'])->name('vote');


/* ROUTE FOR FORUMS */