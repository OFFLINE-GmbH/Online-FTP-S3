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
use Illuminate\Support\Facades\Config;

$app->get('/', function() use ($app) {

    dd(FTP::connection()->getDirListing());

    return view('index');
    return $app->welcome();
});
