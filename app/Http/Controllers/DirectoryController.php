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
        $content = $this->directory->get(rawurldecode($dirname));
        if ($content === false) return ['success' => false];

        return ['success' => true, 'content' => $content];
    }

    public function store()
    {
        return ['success' => $this->directory->create(rawurldecode(Request::get('name')))];
    }

    public function update($dirname)
    {
        return ['success' => $this->directory->move(rawurldecode($dirname), Request::get('newname'))];
    }

    public function destroy($dirname)
    {
        return ['success' => $this->directory->delete(rawurldecode($dirname))];
    }

}