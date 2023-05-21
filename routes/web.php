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


use App\Http\Controllers\Admin\ProfilesController;

Route::controller(ProfilesController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('profiles/create', 'add')->name('profiles.add');
    Route::post('profiles/create', 'create')->name('profiles.create');
    Route::get('profiles', 'index')->name('profiles.index');
    Route::get('profiles/edit', 'edit')->name('profiles.edit');
    Route::post('profiles/edit', 'update')->name('profiles.update');
    Route::get('profiles/delete', 'delete')->name('profiles.delete');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\ProfilesController as PublicProfilesController;
Route::get('/profiles', [PublicProfilesController::class, 'index'])->name('profiles.index');

// 追加
use App\Http\Controllers\LoginWithGoogleController;

// 追加
Route::get("auth/google", [
  LoginWithGoogleController::class,
  "redirectToGoogle",
]);

// 追加
Route::get("auth/google/callback", [
  LoginWithGoogleController::class,
  "handleGoogleCallback",
]);