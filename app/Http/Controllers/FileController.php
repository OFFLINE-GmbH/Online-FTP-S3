<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Input;

class FileController extends Controller
{

    public function show()
    {
        dd(Input::get('filename'));
    }

    public function store()
    {
        dd(Input::get('filename'));
    }

    public function update()
    {
        dd(Input::get('filename'));
    }

    public function destroy()
    {
        dd(Input::get('filename'));
    }

}