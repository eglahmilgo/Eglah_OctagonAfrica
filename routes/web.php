<?php

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
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\Auth\FingerprintController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginpost'])->name('login.post');

Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationpost'])->name('registration.post');

Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');
Route::post('/logout', [AuthManager::class, 'logout'])->name('logout');



Route::get('/fingerprint', [FingerprintController::class, 'showFingerprintForm'])->name('fingerprint');
Route::post('/fingerprint/authenticate', [FingerprintController::class, 'authenticate'])->name('fingerprint.authenticate');
