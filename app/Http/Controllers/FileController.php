<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\FileRepository;
use Illuminate\Http\Request;

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

    public function show(Request $request)
    {
        $path = $request->get('path', '');

        return [
            'contents' => $this->file->contents($path)
        ];
    }

    public function update(Request $request)
    {
        $path     = $request->get('path', '');
        $contents = $request->get('contents', '');

        return [
            'success' => $this->file->update($path, $contents)
        ];
    }
}
