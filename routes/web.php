<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\NewsController;
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

// Route::middleware('guest')->group(function () {

//USER GET related routes
Route::get('/', [PageController::class, "home"])->name('home');
Route::get('/news', [PageController::class, "news"])->middleware('restrictAdmin');
Route::get('/events', [PageController::class, "events"])->middleware('restrictAdmin');
Route::get('/jobs', [PageController::class, "jobs"])->middleware('restrictAdmin');
Route::get('/forums', [PageController::class, "forums"])->middleware('restrictAdmin');
Route::get('/gallery', [PageController::class, "gallery"])->middleware('restrictAdmin');
Route::get('/login', [PageController::class, "login"])->name('login')->middleware('guest');

Route::get('/survey', [PageController::class, "survey"])->middleware('checkAuthRequirements');
Route::get('/additional-info', [PageController::class, "addInfo"])->middleware('checkAuthRequirements');
Route::get('/edit-profile', [PageController::class, "editProfile"])->middleware('authUser');

Route::get('/jobs/{jobs:title}', [PageController::class, "jobsSinglePage"])->middleware('authUser');
Route::get('/events/{events:title}', [PageController::class, "eventsSinglePage"])->middleware('authUser');
Route::get('/news/{news:title}', [PageController::class, "newsSinglePage"])->middleware('authUser');
Route::get('/gallery/{gallery:title}', [PageController::class, "gallerySinglePage"])->middleware('authUser');

//User POST related routes
Route::post('/login', [UserController::class, "login"])->middleware('guest');
Route::post('/logout', [UserController::class, "logout"])->middleware('mustBeLoggedIn');
Route::post('/submit-survey', [UserController::class, "submitSurvey"])->middleware('mustBeLoggedIn');


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

Route::post('/password/forgot',[UserController::class,'sendResetLink'])->name('forgot.password.link');
Route::get('/password/reset/{token}',[UserController::class,'showResetForm'])->name('reset.password.form');
Route::post('/password/reset',[UserController::class,'resetPassword'])->name('reset.password');

//Admin GET related routes
Route::get('/admin/dashboard', [PageController::class, 'adminDashboard'])->middleware('can:visitAdminPages', 'verified');
Route::get('admin/users', [PageController::class, 'adminUsers'])->middleware('can:visitAdminPages');
Route::get('admin/surveys', [PageController::class, 'adminSurvey'])->middleware('can:visitAdminPages');
Route::get('admin/news', [PageController::class, 'adminNews']);
Route::get('admin/events', [PageController::class, 'adminEvents'])->middleware('can:visitAdminPages');
Route::get('admin/gallery', [PageController::class, 'adminGallery'])->middleware('can:visitAdminPages');
Route::get('admin/jobs', [PageController::class, 'adminJobs'])->middleware('can:visitAdminPages');
Route::get('admin/forums', [PageController::class, 'adminForums'])->middleware('can:visitAdminPages');
Route::get('admin/analytics', [PageController::class, "adminAnalytics"])->middleware('can:visitAdminPages');
// add
Route::get('admin/add-alumni', [PageController::class, 'addAlumniPage'])->middleware('can:visitAdminPages');
Route::get('admin/add-news', [PageController::class, 'addNewsPage'])->middleware('can:visitAdminPages');
Route::get('admin/add-events', [PageController::class, 'addEventsPage'])->middleware('can:visitAdminPages');
Route::get('admin/add-jobs', [PageController::class, 'addJobsPage'])->middleware('can:visitAdminPages');
Route::get('admin/add-gallery', [PageController::class, 'addGalleryPage'])->middleware('can:visitAdminPages');
Route::get('admin/add-forums', [PageController::class, 'addForumsPage'])->middleware('can:visitAdminPages');
Route::get('admin/add-survey', [PageController::class, 'addSurveyPage'])->middleware('can:visitAdminPages');
Route::get('admin/add-admin', [PageController::class, 'addAdminPage'])->middleware('can:visitAdminPages');

// edit
Route::get('admin/edit-alumni/{user:username}', [PageController::class, 'editAlumniPage'])->middleware('can:visitAdminPages');
Route::get('admin/edit-news/{news:id}/{title}', [PageController::class, 'editNewsPage'])->middleware('can:visitAdminPages');
Route::get('admin/edit-events/{events:id}/{title}', [PageController::class, 'editEventsPage'])->middleware('can:visitAdminPages');
Route::get('admin/edit-jobs/{jobs:id}/{title}', [PageController::class, 'editJobsPage'])->middleware('can:visitAdminPages');
Route::get('admin/edit-album/{album:id}/{album_name}', [PageController::class, 'editGalleryPage'])->middleware('can:visitAdminPages');


//Admin POST related routes
Route::post('admin/add-news', [NewsController::class, 'addNews'])->middleware('can:visitAdminPages');
Route::post('admin/add-events', [EventsController::class, 'addEvents'])->middleware('can:visitAdminPages');
Route::post('admin/add-jobs', [JobsController::class, 'addJobs'])->middleware('can:visitAdminPages');

//Admin UPDATE related routes
Route::put('admin/update-news/{news:id}', [NewsController::class, 'updateNews'])->middleware('can:visitAdminPages');
Route::put('admin/update-events/{events:id}', [EventsController::class, 'updateEvents'])->middleware('can:visitAdminPages');
Route::put('admin/update-jobs/{jobs:id}', [JobsController::class, 'updateJobs'])->middleware('can:visitAdminPages');

//Admin DELETE related routes
Route::delete('admin/delete-alumni/{user:username}', [AdminController::class, 'deleteUser'])->middleware(['can:visitAdminPages', 'can:delete,user']);
Route::delete('admin/delete-news/{news:id}', [NewsController::class, 'deleteNews'])->middleware('can:visitAdminPages');
Route::delete('admin/delete-events/{events:id}', [EventsController::class, 'deleteEvents'])->middleware('can:visitAdminPages');
Route::delete('admin/delete-jobs/{jobs:id}', [JobsController::class, 'deleteJobs'])->middleware('can:visitAdminPages');
Route::delete('admin/delete-album/{galleryAlbum:id}', [GalleryController::class, 'deleteAlbum'])->middleware('can:visitAdminPages');
Route::delete('admin/delete-photo/{gallery:id}', [GalleryController::class, 'deletePhoto'])->middleware('can:visitAdminPages');