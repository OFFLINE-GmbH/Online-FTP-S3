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
        return response($this->directory->listing($path), 200, ['Content-Type' => 'text/plain']);
    }
}
