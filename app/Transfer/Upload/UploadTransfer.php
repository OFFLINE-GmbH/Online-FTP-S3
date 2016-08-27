<?php

namespace App\Transfer\Upload;


use App\Helpers\Zipper;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Storage;

class UploadTransfer
{
    /**
     * @var array
     */
    protected $files;

    /**
     * @var string
     */
    protected $temp;
    /*
     * @var string
     */
    protected $zip;
    /**
     * @var Filesystem
     */
    private $fs;
    /**
     * @var Zipper
     */
    private $zipper;

    public function __construct(
        array $files,
        $path,
        FilesystemManager $fs,
        Zipper $zipper
    ) {
        $this->files  = $files;
        $this->path   = $path;
        $this->fs     = $fs;
        $this->zipper = $zipper;
    }

    public function start()
    {
        try {
            $this->generateTemp();
            $this->saveTempFiles();
            $this->uploadToRemote();
        } catch (\Exception $e) {
            throw new $e;
        } finally {
            $this->cleanUp();
        }
    }

    /**
     * Generate a temporary directory.
     */
    protected function generateTemp()
    {
        $this->temp = 'uploads/' . uniqid(session_id(), true);
    }

    /**
     * Upload files to the local server.
     */
    protected function saveTempFiles()
    {
        foreach ($this->files as $file) {
            $file->move(storage_path('app/' . $this->temp), $file->getClientOriginalName());
        }
    }

    /**
     * Remove temp files
     */
    protected function cleanUp()
    {
        $this->fs->deleteDirectory($this->temp);
    }

    /**
     * Upload local files to remote server.
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function uploadToRemote()
    {
        foreach ($this->fs->files($this->temp) as $file) {
            $this->fs->cloud()->put(
                $this->path . $this->getBasename($file),
                Storage::get($file)
            );
        }
    }

    /**
     * Returns the basename of a file.
     *
     * @param $file
     *
     * @return mixed
     */
    protected function getBasename($file)
    {
        $parts = explode('/', $file);

        return array_pop($parts);
    }

}