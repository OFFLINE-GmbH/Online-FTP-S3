<?php
namespace App\Repositories;

use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Config;

class FileRepository extends FilesystemRepository
{
    /**
     * Get file contents from server.
     *
     * @param $path
     *
     * @return mixed
     */
    public function contents($path)
    {
        return $this->fs->read($path);
    }
}