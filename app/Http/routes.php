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

$app->get('/', function () use ($app) {
    return view('index');
    return $app->welcome();
});

/*
 | Api
 */
$app->group(['namespace' => 'App\Http\Controllers', 'middleware' => 'CheckFilesize|JsonResponse'], function ($app) {
    /*
     | Files
     */
    $app->get('/file/{filename}', 'FileController@show');
    $app->post('/file', 'FileController@store');
    $app->patch('/file/{filename}', 'FileController@update');
    $app->put('/file/{filename}', 'FileController@rename');
    $app->delete('/file/{filename}', 'FileController@destroy');

    /*
     | Directories
     */
    $app->get('/dir/{dirname:.?}', 'DirectoryController@show');
    $app->post('/dir', 'DirectoryController@store');
    $app->patch('/dir/{dirname}', 'DirectoryController@update');
    $app->delete('/dir/{dirname}', 'DirectoryController@destroy');
});