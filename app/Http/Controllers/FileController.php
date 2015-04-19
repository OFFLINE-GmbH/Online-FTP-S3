<?php namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Repositories\FileRepository;
use Illuminate\Support\Facades\Request;

class FileController extends Controller
{
    /**
     * @var FileRepository
     */
    private $file;

    public function __construct(FileRepository $fileRepository)
    {
        $this->file = $fileRepository;
    }

    public function show($filename)
    {
        $contents = $this->file->get(rawurldecode($filename));
        if ($contents === false) return ['success' => false];

        return ['success' => true, 'contents' => $this->file->get(rawurldecode($filename))];
    }

    public function store()
    {
        dd(Request::all());
    }

    public function update($filename)
    {
        if ($this->file->checkFilesize(Request::get('contents')) === false) {
            return ['success' => false, 'message' => 'File is too large.'];
        }
        return ['success' => $this->file->update(rawurldecode($filename), Request::get('contents'))];
    }

    public function destroy($filename)
    {
        return ['success' => $this->file->delete(rawurldecode($filename))];
    }

}