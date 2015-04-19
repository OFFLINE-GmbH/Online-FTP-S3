<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

class FileController extends Controller
{
    /**
     * @var \App\Repositories\FileRepository
     */
    private $file;

    public function __construct(App\Repositories\FileRepository $fileRepository)
    {
        $this->file = $fileRepository;
    }

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