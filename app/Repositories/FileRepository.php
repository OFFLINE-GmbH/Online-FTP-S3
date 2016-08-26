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

        return $this->fs->cloud()->read($path);
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

        return $this->fs->cloud()->put($path, $contents);
    }

    /**
     * Deletes one or multiple files
     *
     * @param $path
     *
     * @return bool
     */
    public function delete($path)
    {
        if ( ! is_array($path)) {
            $path = [$path];
        }

        foreach ($path as $file) {
            $this->fs->cloud()->delete($file);
        }

        return true;
    }
    
    /**
     * Creates an empty file
     *
     * @param $path
     *
     * @return bool
     */
    public function create($path)
    {
        return $this->fs->cloud()->put($path, '');
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