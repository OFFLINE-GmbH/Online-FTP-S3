<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\FileRepository;

class FileController extends Controller
{
    /**
     * @var FileRepository
     */
    private $file;

    public function __construct(FileRepository $file)
    {
        $this->file = $file;
    }
}
