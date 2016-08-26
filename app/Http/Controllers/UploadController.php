<?php

namespace App\Http\Controllers;

use App\Tools\Zipper;
use App\Transfer\Upload\UploadTransfer;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request, FilesystemManager $fs, Zipper $zipper)
    {
        $files = $request->hasFile('files') ? $request->allFiles()['files'] : [];
        $path  = $request->get('path', '');

        $transfer = new UploadTransfer($files, $path, $fs, $zipper);

        try {
            $transfer->start();
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }

        return response('OK', 200);
    }
}
