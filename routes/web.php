<?php

use App\Http\Controllers\AddMusicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SettingsController;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/music', [MusicController::class, 'index'])->name('music.index');

Route::get('/addMusic', [AddMusicController::class, 'index'])->name('addMusic.index');
Route::post('/addMusic', [AddMusicController::class, 'store'])->name('addMusic.store');

Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

Route::post('/themeNotAuth', [SettingsController::class, 'changeThemeNotAuth'])->name('settings.changeThemeNotAuth');
Route::post('/themeForAuth', [SettingsController::class, 'changeThemeForAuth'])->name('settings.changeThemeForAuth');

Route::post('/langNotAuth', [SettingsController::class, 'changeLangNotAuth'])->name('settings.changeLangNotAuth');
Route::post('/langForAuth', [SettingsController::class, 'changeLangForAuth'])->name('settings.changeLangForAuth');

Route::get('/mail', [MailController::class, 'TestMail'])->name('emails.TestMail');

Route::get('/logout', [LogoutController::class, 'store'])->name('logout.store');

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');