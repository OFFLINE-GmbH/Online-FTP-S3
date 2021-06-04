<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
    $view = Session::get('loggedIn', false) !== true ? 'login' : 'index';

    return view($view);
});

Route::middleware('throttle:10,1')->post('/login', [\App\Http\Controllers\SessionController::class, 'login']);
Route::get('/logout', [\App\Http\Controllers\SessionController::class, 'logout']);

Route::group(['middleware' => ['throttle:5,1']], function () {
    Route::post('/upload', [\App\Http\Controllers\UploadController::class, 'upload']);
    Route::get('/download/{zip}', [\App\Http\Controllers\DownloadController::class, 'download']);
    Route::post('/download', [\App\Http\Controllers\DownloadController::class, 'generate']);
});

Route::group(['prefix' => 'file'], function () {
    Route::get('/', [\App\Http\Controllers\FileController::class, 'show']);
    Route::post('/', [\App\Http\Controllers\FileController::class, 'create']);
    Route::put('/', [\App\Http\Controllers\FileController::class, 'update']);
    Route::delete('/', [\App\Http\Controllers\FileController::class, 'destroy']);
});

Route::group(['prefix' => 'directory'], function () {
    Route::get('/', [\App\Http\Controllers\DirectoryController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\DirectoryController::class, 'create']);
    Route::delete('/', [\App\Http\Controllers\DirectoryController::class, 'destroy']);
});
