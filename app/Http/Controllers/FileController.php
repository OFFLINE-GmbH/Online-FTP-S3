<?php namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Repositories\FileRepository;
use Illuminate\Support\Facades\Request;
use League\Flysystem\Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class FileController extends Controller
{
    /**
     * @var FileRepository
     */
    private $file;

    public function __construct(FileRepository $fileRepository)
    {
        try {
            $this->file = $fileRepository;
        } catch(\Exception $e) {
            die('x');
        }
    }

    public function show($filename)
    {
        if($content = $this->file->get(rawurldecode($filename))) {
            return compact('content');
        }
        return [
            'errors' => [
                'Error while reading file'
            ]
        ];

    }

    public function store()
    {
        if ($this->file->checkFilesize(Request::get('contents')) === false) {
            return ['success' => false, 'message' => 'File is too large.'];
        }
        return ['success' => $this->file->update(rawurldecode(Request::get('name')), Request::get('content'))];
    }

    public function update($filename)
    {
        if ($this->file->checkFilesize(Request::get('contents')) === false) {
            return ['success' => false, 'message' => 'File is too large.'];
        }
        return ['success' => $this->file->update(rawurldecode($filename), Request::get('content'))];
    }

    public function destroy($filename)
    {
        return ['success' => $this->file->delete(rawurldecode($filename))];
    }

}