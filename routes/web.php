<?php

use App\Http\Controllers\DemoFileUploadController;
use App\Http\Controllers\PublicFotoController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
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
    return view('auth.login');
});


Route::get('/demo-file-upload', [DemoFileUploadController::class, 'index'])->name('fileupload.index');
Route::post('/demo-file-upload', [DemoFileUploadController::class, 'store'])->name('fileupload.store');


Route::middleware(['auth', 'verified'])->group(function () {
    //route resource for public file upload
    Route::resource('public-foto', PublicFotoController::class);

    Route::get('home', function () {
        return view('dashboard.home');
    })->name('home');

    Route::get('change-profile', function (Request $request) {
        return view('dashboard.profile');
    })->name('profile');

    Route::resource('users', UserController::class);
});
