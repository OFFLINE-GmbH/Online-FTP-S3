<?php

namespace App\Http\Controllers;

use App\Helpers\Zipper;
use App\Http\Requests\UploadRequest;
use App\Transfer\Upload\UploadTransfer;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(UploadRequest $request, FilesystemManager $fs, Zipper $zipper)
    {
        $files = $request->hasFile('files') ? $request->allFiles()['files'] : [];
        $path  = $request->get('path', '');
        $extract  = (bool)$request->get('extract', false);

        if(count($files) < 1) {
            return response('No files received', 500);
        }

        $transfer = new UploadTransfer($files, $path, $fs, $zipper);

        try {
            $transfer->start($extract);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }

        return response('OK', 200);
    }
}
