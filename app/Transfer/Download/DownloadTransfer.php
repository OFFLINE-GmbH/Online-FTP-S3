<?php

namespace App\Transfer\Download;


use App\Repositories\DirectoryRepository;
use App\Helpers\Zipper;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemManager;

class DownloadTransfer
{
    /**
     * @var array
     */
    protected $path;

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

    public function __construct(array $path, FilesystemManager $fs, Zipper $zipper, DirectoryRepository $dir = null)
    {
        $this->dirRepo = $dir ?: new DirectoryRepository($fs);

        $this->path   = $path;
        $this->fs     = $fs;
        $this->zipper = $zipper;
    }

    public function start()
    {
        try {
            $this->createTempDir();
            $this->fetchRemoteContents();
            $this->createZip();
        } catch (\Exception $e) {
            throw $e;
        } finally {
            $this->cleanUpTemp();
        }

        return $this->zip;
    }

    /**
     * Download all remote contents to the local
     * filesystem.
     */
    protected function fetchRemoteContents()
    {
        foreach ($this->path as $location) {
            $directory = $this->makeAbsolute($location['path']);
            $location  = trim($location['path'], '/');

            $this->downloadDirectory($directory, $location);
        }
    }

    /**
     * Zip all downloaded files.
     * @throws \RuntimeException
     */
    protected function createZip()
    {
        $this->zip = str_random();
        $zipPath   = storage_path('app/downloads/' . $this->zip . '.zip');
        $rootPath  = storage_path('app/' . $this->temp);

        $this->zipper->zipDirectory($rootPath, $zipPath);
    }

    /**
     * Create a local temp directory to store the downloaded
     * files in.
     *
     * @return $this
     */
    protected function createTempDir()
    {
        $this->temp = 'downloads/' . uniqid(session_id(), true);

        $this->fs->makeDirectory($this->temp);

        return $this;
    }

    /**
     * Download a remote directory.
     *
     * @param $directory
     * @param $filter
     */
    protected function downloadDirectory($directory, $filter = null)
    {
        // Make sure it's absolute to the current server root
        $directory = '/' . $directory;

        foreach ($this->dirRepo->listing($directory) as $entry) {
            // Skip this entry if a filter is set and the file does not match it
            if ($filter && $entry['path'] !== $filter) {
                continue;
            }

            if ($entry['type'] === 'file') {
                $this->downloadFile($entry);
            }

            if ($entry['type'] === 'dir') {
                $this->createLocalDirectory($entry['path']);
                $this->downloadDirectory($entry['path']);
            }
        }
    }

    /**
     * Make a path absolute.
     *
     * @param $location
     *
     * @return string
     */
    protected function makeAbsolute($location)
    {
        return dirname(trim($location, '/'));
    }

    /**
     * Download a remote file to the local temp dir.
     *
     * @param $entry
     */
    protected function downloadFile($entry)
    {
        $this->fs->put(
            $this->temp . '/' . $entry['path'],
            $this->fs->cloud()->read($entry['path'])
        );
    }

    /**
     * @param $path
     */
    protected function createLocalDirectory($path)
    {
        $this->fs->makeDirectory($this->temp . '/' . $path);
    }

    /**
     * Remove temp files.
     */
    protected function cleanUpTemp()
    {
        $this->fs->deleteDirectory($this->temp);
    }

}