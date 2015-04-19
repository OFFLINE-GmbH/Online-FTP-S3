<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

class FileController extends Controller {

    public function index() {
        dd(Input::get('filename'));
    }

}