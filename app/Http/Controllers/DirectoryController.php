<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\DirectoryRepository;
use Illuminate\Http\Request;

class DirectoryController extends Controller
{
    /**
     * @var DirectoryRepository
     */
    private $directory;

    public function __construct(DirectoryRepository $directory)
    {
        $this->directory = $directory;
    }

    public function index(Request $request)
    {
        $path = $request->get('path', '/');

        return [
            'listing' => $this->directory->listing($path)
        ];
    }

    public function create(Request $request)
    {
        $path = $request->get('path', '');

        return response([
            'success' => $this->directory->create($path),
        ], 201);
    }

    public function destroy(Request $request)
    {
        $path = $request->input('path', null);
        
        $this->directory->delete($path);
    }
}
