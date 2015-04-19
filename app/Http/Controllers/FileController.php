<?php namespace App\Http\Controllers;

use Anchu\Ftp\Facades\Ftp;
use App\Repositories\FileRepository;
use Illuminate\Support\Facades\Input;
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
        dd(rawurldecode($filename));
        dd(FTP::connection(getenv('FTP_SERVER'))->getDirListing());
    }

    public function store()
    {
        dd(Request::all());
    }

    public function update($filename)
    {
        dd(Input::get('filename'));
    }

    public function destroy($filename)
    {
        dd($filename);
    }

}