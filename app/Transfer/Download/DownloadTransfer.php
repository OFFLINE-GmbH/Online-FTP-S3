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
        // Download all files into this directory

        foreach ($this->path as $location) {
            $directory = '/' . dirname($location);
            $name      = str_replace($directory, '', $location);

            $this->scanDirectory($directory, $name);
        }

        // $this->fs->get();
        // Create zip
        // Delete temporary directory
        // Send zip to user
        // Delete zip
    }

    protected function createTempDir()
    {
        $this->temp = 'downloads/' . uniqid(session_id(), true);

        $this->fs->drive('local')->makeDirectory($this->temp);

        return $this;
    }

    /**
     * @param $directory
     * @param $filter
     */
    protected function scanDirectory($directory, $filter = null)
    {
        foreach ($this->dirRepo->listing($directory) as $entry) {
            if ($filter && $entry['basename'] !== $filter) {
                continue;
            }

            if ($entry['type'] === 'file') {
                $this->fs->drive('local')->put(
                    $this->temp . '/' . $entry['path'] . '/' . $entry['basename'],
                    $this->fs->read($entry['path'])
                );
            }

            if ($entry['type'] === 'dir') {
                $this->fs->makeDirectory($this->temp . '/' . $entry['path']);
                $this->scanDirectory('/' . $entry['path']);
            }
        }
    }
}