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
        if ($content = $this->file->get($filename)) {
            return compact('content');
        }
    }

    public function store()
    {
        if ($this->file->update(Request::get('name'), Request::get('content'))) {
            return ['content' => Request::get('name') . ' created successfully'];
        }
    }

    public function update($filename)
    {
        if ($this->file->update($filename, Request::get('content'))) {
            return ['content' => $filename . ' updated successfully'];
        }
    }

    public function destroy($filename)
    {
        if ($this->file->delete($filename)) {
            return ['content' => $filename . ' deleted successfully'];
        }
    }

}