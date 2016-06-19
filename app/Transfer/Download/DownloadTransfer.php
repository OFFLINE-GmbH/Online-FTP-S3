<?php

namespace App\Transfer\Download;


use App\Repositories\DirectoryRepository;
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
    /**
     * @var Filesystem
     */
    private $fs;

    public function __construct(array $path, FilesystemManager $fs, DirectoryRepository $dir = null)
    {
        $this->dirRepo = $dir ?: new DirectoryRepository($fs);

        $this->path = $path;
        $this->fs   = $fs;

        $this->createTempDir();
        $this->fetchRemoteContents();

        // Create zip
        // Delete temporary directory
        // Send zip to user
        // Delete zip
    }

    /**
     * Download all remote contents to the local
     * filesystem.
     */
    protected function fetchRemoteContents()
    {
        foreach ($this->path as $location) {
            $directory = $this->makeAbsolute($location);
            $location = trim($location, '/');

            $this->downloadDirectory($directory, $location);
        }
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

        $this->fs->drive('local')->makeDirectory($this->temp);

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
        $this->fs->drive('local')->put(
            $this->temp . '/' . $entry['path'],
            $this->fs->read($entry['path'])
        );
    }

    /**
     * @param $path
     */
    protected function createLocalDirectory($path)
    {
        $this->fs->drive('local')->makeDirectory($this->temp . '/' . $path);
    }
}