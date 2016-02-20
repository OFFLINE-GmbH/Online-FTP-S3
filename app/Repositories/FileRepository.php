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
        $this->checkPath($path);

        return $this->fs->read($path);
    }

    /**
     * Updates a file's contents.
     *
     * @param string $path
     * @param string $contents
     *
     * @throws InvalidArgumentException
     * @return mixed
     */
    public function update($path = '', $contents = '')
    {
        $this->checkPath($path);

        return $this->fs->put($path, $contents);
    }

    /**
     * Validates a path.
     *
     * @throws InvalidArgumentException
     *
     * @param $path
     */
    protected function checkPath($path)
    {
        if ($path == '') {
            throw new InvalidArgumentException('Please specify a file path.');
        }
    }
}