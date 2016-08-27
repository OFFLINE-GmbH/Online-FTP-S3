<?php

namespace App\Http\Controllers;

use App\Helpers\Zipper;
use App\Transfer\Download\DownloadTransfer;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function generate(Request $request, FilesystemManager $fs, Zipper $zipper)
    {
        $path = $request->input('path', []);

        $transfer = new DownloadTransfer($path, $fs, $zipper);

        try {
            $zip = $transfer->start();
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }

        return response($zip);
    }

    public function download(Request $request)
    {
        $file = preg_replace('/[^a-zA-Z0-9]/', '', $request->zip);
        return response()->download(storage_path('app/downloads/' . $file . '.zip'), str_random() . '.zip');
    }
}
