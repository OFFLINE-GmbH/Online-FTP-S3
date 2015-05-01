<?php namespace App\Http\Controllers;

use App\Repositories\DirectoryRepository;
use Illuminate\Support\Facades\Request;

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

    public function show($dirname)
    {
        if ($content = $this->directory->get($dirname)) {
            return compact('content');
        }
    }

    public function store()
    {
        if ($this->directory->create(Request::get('name'))) {
            return ['content' => Request::get('name') . ' created successfully'];
        }
    }

    public function update($dirname)
    {
        if ($this->directory->move($dirname, Request::get('newname'))) {
            return ['content' => $dirname . ' updated successfully'];
        }
    }

    public function destroy($dirname)
    {
        if ($this->directory->delete($dirname)) {
            return ['content' => $dirname . ' deleted successfully'];
        }
    }

}