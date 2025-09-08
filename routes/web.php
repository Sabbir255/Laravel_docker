<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\WeDoController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, "login"])->name('login');
    Route::post('/login_check', [AuthController::class, "login_check"])->name('login_check');
    Route::get('/google_auth', [GoogleAuthController::class, "google_auth"])->name('google_auth');
    Route::get('/auth/google/callback', [GoogleAuthController::class, "google_auth_callback"])->name('google_auth_callback');
});

Route::middleware('auth')->group(function () {
    Route::post('/loged_out', [AuthController::class, "loged_out"])->name('loged_out');
    Route::get('/dashboard', [DashboardController::class, "dashboard"])->name('dashboard');


    Route::get('/banner_list', [BannerController::class, "banner_list"])->name('banner_list');
    Route::get('/banner_create', [BannerController::class, "banner_create"])->name('banner_create');
    Route::post('/banner_store', [BannerController::class, "banner_store"])->name('banner_store');
    Route::get('/banner_edit/{id}', [BannerController::class, "banner_edit"])->name('banner_edit');
    Route::post('/banner_update/{id}', [BannerController::class, "banner_update"])->name('banner_update');
    Route::get('/banner_delete/{id}', [BannerController::class, "banner_delete"])->name('banner_delete');

    Route::get('/career_list', [CareerController::class, "career_list"])->name('career_list');
    Route::get('/career_create', [CareerController::class, "career_create"])->name('career_create');
    Route::post('/career_store', [CareerController::class, "career_store"])->name('career_store');
    Route::get('/career_edit/{id}', [CareerController::class, "career_edit"])->name('career_edit');
    Route::post('/career_update/{id}', [CareerController::class, "career_update"])->name('career_update');
    Route::get('/career_delete/{id}', [CareerController::class, "career_delete"])->name('career_delete');

    Route::get('/wedo_list', [WeDoController::class, "wedo_list"])->name('wedo_list');
    Route::get('/wedo_create', [WeDoController::class, "wedo_create"])->name('wedo_create');
    Route::post('/wedo_store', [WeDoController::class, "wedo_store"])->name('wedo_store');
    Route::get('/wedo_edit/{id}', [WeDoController::class, "wedo_edit"])->name('wedo_edit');
    Route::post('/wedo_update/{id}', [WeDoController::class, "wedo_update"])->name('wedo_update');
    Route::get('/wedo_delete/{id}', [WeDoController::class, "wedo_delete"])->name('wedo_delete');
});
