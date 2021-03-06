<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'confirm']);

Route::get('email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/threads', 'ThreadController@index')->name('threads.index');
Route::get('/threads/create', 'ThreadController@create')->name('threads.create');
Route::get('/threads/{channel:slug}/{thread}', 'ThreadController@show');
Route::delete('/threads/{channel:slug}/{thread}', 'ThreadController@destroy');

Route::post('/threads', 'ThreadController@store');
Route::get('/threads/{channel:slug}', 'ThreadController@index');

Route::post('/threads/{channel}/{thread}/replies', 'ReplyController@store')->name('replies.store');

Route::patch('/replies/{reply}', 'ReplyController@update')->name('reply.update');
Route::delete('/replies/{reply}', 'ReplyController@destroy')->name('replies.destroy');
Route::post('/replies/{reply}/favorites', 'FavoritesController@store')->name('favorites.store');
Route::delete('/replies/{reply}/favorites', 'FavoritesController@destroy')->name('favorites.destroy');



Route::get('/profiles/{user}', 'ProfileController@show')->name('profile.show');


// Route::get('/data', function () {
//     $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));
//     dd($analyticsData);
// });

Route::group(['middleware' => 'auth'], function () {
});


Route::get('/contact', 'ContactController@show')->name('contact.show');
Route::post('/contact', 'ContactController@store')->name('contact.store');
