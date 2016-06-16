<?php

namespace App\Http\Controllers;

use App\Transfer\Download\DownloadTransfer;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DownloadController extends Controller
{
    public function get(Request $request, FilesystemManager $fs)
    {
        $path = $request->input('path', []);
        
        new DownloadTransfer($path, $fs);

    }
}
