<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

/** home route */
Route::get('/', [AuthController::class, 'showHome'])->name('home.show');


/** signup password routes */
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup.show');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');


Route::get('/signup/verify/{userId}', [AuthController::class, 'showSignupVerify'])->where('userId', '[0-9]+')->name('verify.show');
Route::post('/signup/verify/{userId}', [AuthController::class, 'sendEmailValidation'])->where('userId', '[0-9]+')->name('verify.post');


/** signin routes */
Route::get('/signin', [AuthController::class, 'showSigninForm'])->name('signin.show');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin.post');


Route::get('/signin/{userId}', [AuthController::class, 'showSigninFirstTime'])->where('userId', '[0-9]+')->name('firstAuth.show');


Route::get('/signin/{userId}/{userNewEmail}', [AuthController::class, 'showSigninAfterNewEmailValidation'])->where('userId', '[0-9]+')->where('userNewEmail', '[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}')->name('newEmailAuth.show');


/** edit password routes */
Route::get('/signin/forgotPassword', [AuthController::class, 'showForgotPasswordForm'])->name('forgotPassword.show');
Route::post('/signin/forgotPassword', [AuthController::class, 'forgotPassword'])->name('forgotPassword.post');


Route::get('/signin/forgotPassword/{userId}', [AuthController::class, 'showEditPasswordForm'])->where('userId', '[0-9]+')->name('editPassword.show');
Route::post('/signin/forgotPassword/{userId}', [AuthController::class, 'editPassword'])->where('userId', '[0-9]+')->name('editPassword.post');


/** logout route */
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/** user signin routes */
Route::get('/users/{userId}/dashboard', [AuthController::class, 'showUserDashboard'])->where('userId', '[0-9]+')->name('dashboard.show');


Route::get('/users/{userId}/dashboard/informations', [AuthController::class, 'showUserDashboardInfosForm'])->where('userId', '[0-9]+')->name('informations.show');
Route::put('/users/{userId}/dashboard/informations', [AuthController::class, 'updateInformations'])->where('userId', '[0-9]+')->name('informations.update');


Route::put('/users/{userId}/dashboard/avatar', [AuthController::class, 'updateAvatar'])->where('userId', '[0-9]+')->name('avatar.update');
Route::post('/users/{userId}/dashboard/avatar', [AuthController::class, 'deleteAvatar'])->where('userId', '[0-9]+')->name('avatar.delete');


Route::get('/users/{userId}/dashboard/email', [AuthController::class, 'showUserDashboardEmailForm'])->where('userId', '[0-9]+')->name('email.show');
Route::put('/users/{userId}/dashboard/email', [AuthController::class, 'updateEmail'])->where('userId', '[0-9]+')->name('email.update');


Route::get('/users/{userId}/dashboard/password', [AuthController::class, 'showUserDashboardPasswordForm'])->where('userId', '[0-9]+')->name('password.show');
Route::put('/users/{userId}/dashboard/password', [AuthController::class, 'updatePassword'])->where('userId', '[0-9]+')->name('password.update');

Route::post('/users/{userId}/delete', [AuthController::class, 'deleteUser'])->where('userId', '[0-9]+')->name('user.delete');