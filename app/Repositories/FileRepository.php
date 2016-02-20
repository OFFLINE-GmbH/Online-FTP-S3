<?php
namespace App\Repositories;

use InvalidArgumentException;

class FileRepository extends FilesystemRepository
{
    /**
     * Get file contents from server.
     *
     * @param $path
     *
     * @throws InvalidArgumentException
     * @return mixed
     */
    public function contents($path = '')
    {
        if ($path == '') {
            throw new InvalidArgumentException('Please specify a file path.');
        }

        return $this->fs->read($path);
    }
}