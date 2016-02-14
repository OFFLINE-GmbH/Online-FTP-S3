<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\DirectoryRepository;

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

    public function index()
    {
        return $this->directory->listing('/');
    }
}
