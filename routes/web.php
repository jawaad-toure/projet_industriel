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


Route::get('/', [AuthController::class, 'showHome'])->name('home.show');

Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup.show');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');
Route::get('/signup/verify/{userId}', [AuthController::class, 'showSignupVerify'])->where('userId', '[0-9]+')->name('signup.verify');
Route::post('/signup/verify/{userId}', [AuthController::class, 'sendEmailValidation'])->where('userId', '[0-9]+')->name('signup.verify.send');

Route::get('/signin', [AuthController::class, 'showSigninForm'])->name('signin.show');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin.post');
Route::get('/signin/{userId}', [AuthController::class, 'showSigninFirstTime'])->where('userId', '[0-9]+')->name('signin.firsttime.show');
Route::get('/signin/forgot', [AuthController::class, 'showForgotPasswordForm'])->name('forgot.password.show');
Route::post('/signin/forgot', [AuthController::class, 'forgotPassword'])->name('forgot.password.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/users/{userId}/dashboard', [AuthController::class, 'showUserDashboard'])->where('userId', '[0-9]+')->name('user.dashboard.show');

Route::get('/users/{userId}/dashboard/informations', [AuthController::class, 'showUserInformationsForm'])->where('userId', '[0-9]+')->name('user.informations.show');
Route::put('/users/{userId}/dashboard/informations/update', [AuthController::class, 'updateInformations'])->where('userId', '[0-9]+')->name('user.informations.update');

Route::put('/users/{userId}/dashboard/avatar', [AuthController::class, 'updateAvatar'])->where('userId', '[0-9]+')->name('user.avatar.update');
Route::post('/users/{userId}/dashboard/avatar', [AuthController::class, 'deleteAvatar'])->where('userId', '[0-9]+')->name('user.avatar.delete');

Route::put('/users/{userId}/dashboard/email', [AuthController::class, 'updateEmail'])->where('userId', '[0-9]+')->name('user.email.update');

Route::put('/users/{userId}/dashboard/password', [AuthController::class, 'updatePassword'])->where('userId', '[0-9]+')->name('user.password.update');

Route::post('/users/{userId}/delete', [AuthController::class, 'deleteUser'])->where('userId', '[0-9]+')->name('user.delete');