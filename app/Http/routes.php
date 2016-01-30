<?php


Route::group([
    'prefix'     => 'api',
    'namespace'  => 'App\Http\Controllers',
    'middleware' => 'CheckFilesize|JsonResponse'],
    function ($app) {
        /*
         | Files
         */
        $app->get('/file/{filename:.*}', 'FileController@show');
        $app->post('/file', 'FileController@store');
        $app->patch('/file/{filename:.*}', 'FileController@update');
        $app->put('/file/{filename:.*}', 'FileController@rename');
        $app->delete('/file/{filename:.*}', 'FileController@destroy');

        /*
         | Directories
         */
        $app->get('/dir/{dirname:.*}', 'DirectoryController@show');
        $app->post('/dir', 'DirectoryController@store');
        $app->patch('/dir/{dirname:.*}', 'DirectoryController@update');
        $app->delete('/dir/{dirname:.*}', 'DirectoryController@destroy');
    });

Route::group(['middleware' => ['web']], function () {
    

        $app->get('/', function () use ($app) {
            return view('index');
        });
        $app->get('/dir/{path:.*}', function () use ($app) {
            return view('index');
        });
});
