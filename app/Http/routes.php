<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Anchu\Ftp\Facades\Ftp;

$app->get('/', function () use ($app) {
    return view('index');
    return $app->welcome();
});


/*
 | Files
 */
$app->get('/file/{filename}', 'App\Http\Controllers\FileController@show');
$app->post('/file', 'App\Http\Controllers\FileController@store');
$app->patch('/file/{filename}', 'App\Http\Controllers\FileController@update');
$app->delete('/file/{filename}', 'App\Http\Controllers\FileController@destroy');

/*
 | Directories
 */
$app->get('/dir/{dirname}', 'App\Http\Controllers\DirectoryController@show');
$app->post('/dir', 'App\Http\Controllers\DirectoryController@store');
$app->patch('/dir/{dirname}', 'App\Http\Controllers\DirectoryController@update');
$app->delete('/dir/{dirname}', 'App\Http\Controllers\DirectoryController@destroy');
