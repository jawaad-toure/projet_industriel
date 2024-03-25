<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StepController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\QuantityController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\StarCommentController;


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

/** ------------------------------------------------------------------------------------------------ */
/** home route */
Route::get('/', [AuthController::class, 'showHome'])
    ->name('home.show');

/** ------------------------------------------------------------------------------------------------ */
/** signup password routes */
Route::get('/signup', [AuthController::class, 'showSignupForm'])
    ->name('signup.show');

Route::post('/signup', [AuthController::class, 'signup'])
    ->name('signup.post');

Route::get('/signup/verify/{userId}', [AuthController::class, 'showSignupVerify'])
    ->where('userId', '[0-9]+')->name('verify.show');

Route::post('/signup/verify/{userId}', [AuthController::class, 'sendEmailValidation'])
    ->where('userId', '[0-9]+')
    ->name('verify.post');


/** ------------------------------------------------------------------------------------------------ */
/** signin routes */
Route::get('/signin', [AuthController::class, 'showSigninForm'])
    ->name('signin.show');

Route::post('/signin', [AuthController::class, 'signin'])
    ->name('signin.post');

Route::get('/signin/{userId}', [AuthController::class, 'showSigninFirstTime'])
    ->where('userId', '[0-9]+')
    ->name('firstAuth.show');

Route::get('/signin/{userId}/{userNewEmail}', [AuthController::class, 'showSigninAfterNewEmailValidation'])
    ->where('userId', '[0-9]+')
    ->where('userNewEmail', '[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}')
    ->name('newEmailAuth.show');


/** ------------------------------------------------------------------------------------------------ */
/** edit password routes */
Route::get('/signin/forgot-password', [AuthController::class, 'showForgotPasswordForm'])
    ->name('forgotPassword.show');

Route::post('/signin/forgot-password', [AuthController::class, 'forgotPassword'])
    ->name('forgotPassword.post');

Route::get('/signin/forgot-password/{userId}', [AuthController::class, 'showEditPasswordForm'])
    ->where('userId', '[0-9]+')
    ->name('editPassword.show');

Route::post('/signin/forgot-password/{userId}', [AuthController::class, 'editPassword'])
    ->where('userId', '[0-9]+')
    ->name('editPassword.post');


/** ------------------------------------------------------------------------------------------------ */
/** logout route */
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/** ------------------------------------------------------------------------------------------------ */
/** user signin routes */
Route::get('/dashboard/{userId}', [AuthController::class, 'showUserDashboard'])
    ->where('userId', '[0-9]+')
    ->name('dashboard.show');

Route::get('/dashboard/{userId}/informations', [AuthController::class, 'showUserDashboardInfosForm'])
    ->where('userId', '[0-9]+')
    ->name('informations.show');

Route::put('/dashboard/{userId}/informations', [AuthController::class, 'updateInformations'])
    ->where('userId', '[0-9]+')
    ->name('informations.update');

Route::put('/dashboard/{userId}/avatar', [AuthController::class, 'updateAvatar'])
    ->where('userId', '[0-9]+')
    ->name('avatar.update');

Route::delete('/dashboard/{userId}/avatar', [AuthController::class, 'deleteAvatar'])
    ->where('userId', '[0-9]+')
    ->name('avatar.delete');

Route::get('/dashboard/{userId}/email', [AuthController::class, 'showUserDashboardEmailForm'])
    ->where('userId', '[0-9]+')
    ->name('email.show');

Route::put('/dashboard/{userId}/email', [AuthController::class, 'updateEmail'])
    ->where('userId', '[0-9]+')
    ->name('email.update');

Route::get('}/dashboard/{userId/password', [AuthController::class, 'showUserDashboardPasswordForm'])
    ->where('userId', '[0-9]+')
    ->name('password.show');

Route::put('/dashboard/{userId}/password', [AuthController::class, 'updatePassword'])
    ->where('userId', '[0-9]+')
    ->name('password.update');

Route::delete('/users/{userId}/delete', [AuthController::class, 'deleteUser'])
    ->where('userId', '[0-9]+')
    ->name('user.delete');

/** ------------------------------------------------------------------------------------------------ */
/** recipe routes */

Route::get('/recipes/{recipeId}', [RecipeController::class, 'showRecipe'])
    ->where('recipeId', '[0-9]+')
    ->name('recipe.show');

Route::get('/dashboard/{userId}/create-recipe', [RecipeController::class, 'showCreateRecipeForm'])
    ->where('userId', '[0-9]+')
    ->name('createRecipeForm.show');

Route::post('/dashboard/{userId}/create-recipe', [RecipeController::class, 'insertRecipe'])
    ->where('userId', '[0-9]+')
    ->name('recipe.post');

Route::get('/dashboard/{userId}/update-recipe/{recipeId}', [RecipeController::class, 'showUpdateRecipeForm'])
    ->where('userId', '[0-9]+')
    ->where('recipeId', '[0-9]+')
    ->name('updateRecipeForm.show');

Route::put('/dashboard/{userId}/update-recipe/{recipeId}', [RecipeController::class, 'updateRecipe'])
    ->where('userId', '[0-9]+')
    ->where('recipeId', '[0-9]+')
    ->name('recipe.update');

Route::put('/dashboard/{userId}/{recipeId}/public', [RecipeController::class, 'recipeSetOnPublic'])
    ->where('userId', '[0-9]+')
    ->where('recipeId', '[0-9]+')
    ->name('recipeSetOnPublic.update');

Route::put('/dashboard/{userId}/{recipeId}/private', [RecipeController::class, 'recipeSetOnPrivate'])
    ->where('userId', '[0-9]+')
    ->where('recipeId', '[0-9]+')
    ->name('recipeSetOnPrivate.update');

Route::delete('/dashboard/{userId}/{recipeId}/delete-recipe', [RecipeController::class, 'deleteRecipe'])
    ->where('userId', '[0-9]+')
    ->where('recipeId', '[0-9]+')
    ->name('recipe.delete');

/** ------------------------------------------------------------------------------------------------ */
/** quantities routes */
Route::post('/dashboard/{userId}/update-recipe/{recipeId}/quantity', [QuantityController::class, 'insertQuantity'])
    ->where('userId', '[0-9]+')
    ->where('recipeId', '[0-9]+')
    ->name('quantity.post');

Route::put('/dashboard/{userId}/update-recipe/{recipeId}/quantity/{quantityId}', [QuantityController::class, 'updateQuantity'])
    ->where('userId', '[0-9]+')
    ->where('recipeId', '[0-9]+')
    ->where('quantityId', '[0-9]+')
    ->name('quantity.update');

Route::delete('/dashboard/{userId}/update-recipe/{recipeId}/quantity/{quantityId}', [QuantityController::class, 'deleteQuantity'])
    ->where('userId', '[0-9]+')
    ->where('recipeId', '[0-9]+')
    ->where('quantityId', '[0-9]+')
    ->name('quantity.delete');

/** ------------------------------------------------------------------------------------------------ */
/** steps routes */

Route::post('/dashboard/{userId}/update-recipe/{recipeId}/step', [StepController::class, 'insertStep'])
    ->where('userId', '[0-9]+')
    ->where('recipeId', '[0-9]+')
    ->name('step.post');

Route::put('/dashboard/{userId}/update-recipe/{recipeId}/step/{stepId}', [StepController::class, 'updateStep'])
    ->where('userId', '[0-9]+')
    ->where('recipeId', '[0-9]+')
    ->where('stepId', '[0-9]+')
    ->name('step.update');

Route::delete('/dashboard/{userId}/update-recipe/{recipeId}/step/{stepId}', [StepController::class, 'deleteStep'])
    ->where('userId', '[0-9]+')
    ->where('recipeId', '[0-9]+')
    ->where('stepId', '[0-9]+')
    ->name('step.delete');

/** ------------------------------------------------------------------------------------------------ */
/** image routes */

Route::post('/dashboard/{userId}/update-recipe/{recipeId}/image', [ImageController::class, 'insertImages'])
    ->where('userId', '[0-9]+')
    ->where('recipeId', '[0-9]+')
    ->name('image.post');

Route::delete('/dashboard/{userId}/update-recipe/{recipeId}/image/{imageId}', [ImageController::class, 'deleteImage'])
    ->where('userId', '[0-9]+')
    ->where('recipeId', '[0-9]+')
    ->where('imageId', '[0-9]+')
    ->name('image.delete');

/** ------------------------------------------------------------------------------------------------ */
/** stars and comment routes */

Route::get('/recipes/{recipeId}/rate', [StarCommentController::class, 'showStarCommentForm'])
    ->where('recipeId', '[0-9]+')
    ->name('starCommentForm.show');

Route::post('/recipes/{recipeId}/rate', [StarCommentController::class, 'insertStarComment'])
    ->where('recipeId', '[0-9]+')
    ->name('starComment.post');

Route::delete('/dashboard/{userId}/{starCommentId}/delete-comment', [StarCommentController::class, 'deleteStarComment'])
    ->where('userId', '[0-9]+')
    ->where('starCommentId', '[0-9]+')
    ->name('starComment.delete');


