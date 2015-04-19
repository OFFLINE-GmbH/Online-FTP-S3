<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

class DirectoryController extends Controller
{

    public function show()
    {
        dd(Input::get('dirname'));
    }

    public function store()
    {
        dd(Input::get('dirname'));
    }

    public function update()
    {
        dd(Input::get('dirname'));
    }

    public function destroy()
    {
        dd(Input::get('dirname'));
    }

}