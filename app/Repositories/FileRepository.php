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
        return $this->flysystem->read(rawurldecode($filename));
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
        return $this->update(rawurldecode($filename), $contents);
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
        return $this->flysystem->put(rawurldecode($filename), $contents);
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
        return $this->flysystem->delete(rawurldecode($filename));
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