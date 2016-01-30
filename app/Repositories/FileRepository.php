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
        return $this->flysystem->read($filename);
    }

    /**
     * Creates a file
     *
     * @param $filename
     * @param $contents
     *
     * @return bool
     */
    function create($filename, $contents)
    {
        return $this->update($filename, $contents);
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
        return $this->flysystem->put($filename, $contents);
    }

    /**
     * Renames a file
     *
     * @param $from
     * @param $to
     *
     * @return bool
     *
     */
    function rename($from, $to)
    {
        return $this->flysystem->rename($from, $to);
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