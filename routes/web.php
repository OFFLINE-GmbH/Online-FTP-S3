<?php

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

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        $view = \Session::get('loggedIn', false) !== true ? 'login' : 'index';

        return view($view);
    });
    Route::post('/login', 'SessionController@login');
    Route::get('/logout', 'SessionController@logout');


    Route::get('/download/{zip}', 'DownloadController@download');
    Route::post('/download', 'DownloadController@generate');

    Route::post('/upload', 'UploadController@upload');

    Route::group(['prefix' => 'file'], function () {
        Route::get('/', 'FileController@show');
        Route::post('/', 'FileController@create');
        Route::put('/', 'FileController@update');
        Route::delete('/', 'FileController@destroy');
    });

    Route::group(['prefix' => 'directory'], function () {
        Route::get('/', 'DirectoryController@index');
        Route::post('/', 'DirectoryController@create');
        Route::delete('/', 'DirectoryController@destroy');
    });
});
