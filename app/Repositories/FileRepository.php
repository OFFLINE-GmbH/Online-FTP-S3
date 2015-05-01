<?php namespace App\Repositories;

use GrahamCampbell\Flysystem\FlysystemManager;

class FileRepository
{
    /**
     * @var FlysystemManager
     */
    private $flysystem;

    /**
     *
     */
    function __construct(FlysystemManager $flysystem)
    {
        $this->flysystem = $flysystem;
    }

    /**
     * Returns contents of a file
     *
     * @param $filename
     *
     * @return bool|string
     */
    function get($filename)
    {
        try {
            $file = $this->flysystem->read($filename);
        } catch(Exception $e) {
            die($e->getMessage());
            return false;
        }
        return $file;
    }

    /**
     * Updates content of a file
     *
     * @param $filename
     * @param $contents
     *
     * @return bool
     */
    function update($filename, $contents)
    {
        return $this->flysystem->write($filename, $contents);
    }

    /**
     * Deletes a file
     *
     * @param $filename
     *
     * @return bool
     */
    function delete($filename)
    {
        return $this->flysystem->delete($filename);
    }

    /**
     * Checks the size of the input data
     *
     * @param $content
     *
     * @return bool
     */
    public function checkFilesize($content)
    {
        return mb_strlen($content, '8bit') <= getenv('MAX_FILE_SIZE');
    }
}