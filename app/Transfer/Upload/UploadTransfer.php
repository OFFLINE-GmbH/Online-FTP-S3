<?php

namespace App\Transfer\Upload;


use App\Helpers\Zipper;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\UploadedFile;
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

    public function start($extract)
    {
        try {
            $this->generateTemp();
            $this->saveTempFiles($extract);
            $this->uploadToRemote();
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
     * Upload files to the local filesystem.
     */
    protected function saveTempFiles($extract)
    {
        $base = storage_path('app/' . $this->temp);
        foreach ($this->files as $file) {
            /** @var $file UploadedFile */
            if ($extract === true && $file->guessExtension() === 'zip') {
                (new Zipper())->unzip($file->getRealPath(), $base);
            } else {
                $file->move($base, $file->getClientOriginalName());
            }
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
    protected function uploadToRemote($base = null)
    {
        $folder = $base ? $this->temp . '/' . $base : $this->temp;
        $target = $base ? $this->path . '/' . $base : $this->path;

        foreach ($this->fs->files($folder) as $file) {
            $this->fs->cloud()->put(
                sprintf('%s/%s', $target, $this->getBasename($file)),
                Storage::get($file)
            );
        }

        if ($dirs = $this->fs->directories($folder)) {
            $this->createDirs($base, $dirs, $target);
        }
    }

    /**
     * Creates all uploaded directories on the remote server.
     *
     * @param $base
     * @param $dirs
     * @param $target
     */
    protected function createDirs($base, $dirs, $target)
    {
        foreach ($dirs as $dir) {
            $this->fs->cloud()->makeDirectory(
                sprintf('%s/%s', $target, $this->getBasename($dir))
            );
            $this->uploadToRemote($base . '/' . $this->getBasename($dir));
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
