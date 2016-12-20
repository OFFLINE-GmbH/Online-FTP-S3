<?php

namespace App\Http\Controllers;

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

        $contents = $this->file->contents($path);
        $isBinary = mb_detect_encoding($contents) === false;

        if ($isBinary) {
            $contents = base64_encode($contents);
        }

        return [
            'contents' => $contents,
            'download' => $isBinary,
        ];
    }

    public function create(Request $request)
    {
        $path = $request->get('path', '');

        return response([
            'success' => $this->file->create($path),
        ], 201);
    }

    public function update(Request $request)
    {
        $path     = $request->get('path', '');
        $contents = $request->get('contents', '');

        return [
            'success' => $this->file->update($path, $contents),
        ];
    }

    public function destroy(Request $request)
    {
        $path = $request->input('path', null);

        return [
            'success' => $this->file->delete($path),
        ];
    }
}
