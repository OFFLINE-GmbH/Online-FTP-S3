<?php namespace App\Http\Controllers;

use App\Repositories\DirectoryRepository;
use Illuminate\Support\Facades\Input;

class DirectoryController extends Controller
{
    /**
     * @var DirectoryRepository
     */
    private $directory;

    public function __construct(DirectoryRepository $directoryRepository)
    {
        $this->directory = $directoryRepository;
    }

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