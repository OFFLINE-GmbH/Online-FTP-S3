<?php namespace App\Repositories;

use Anchu\Ftp\Facades\Ftp;
use GrahamCampbell\Flysystem\FlysystemManager;
use Illuminate\Support\Facades\Storage;

class DirectoryRepository
{
    /**
     * @var FlysystemManager
     */
    private $flysystem;

    function __construct(FlysystemManager $flysystem)
    {
        $this->flysystem = $flysystem;
    }

    /**
     * Returns contents of a directory
     *
     * @param $dirname
     *
     * @return array
     */
    function get($dirname)
    {
        /**
         * @TODO: Check if dir exists!
         */
        return $this->flysystem->listContents($dirname);
    }

    /**
     * Creates a directory
     *
     * @param $dirname
     *
     * @return array
     */
    function create($dirname)
    {
        return $this->flysystem->createDir($dirname);
    }

    /**
     * Moves a directory
     *
     * @param $from
     * @param $to
     *
     * @return array
     */
    function move($from, $to)
    {
        return $this->flysystem->rename($from, $to);
    }

    /**
     * Deletes a directory
     *
     * @param $dirname
     *
     * @return bool
     */
    function delete($dirname)
    {
        return $this->flysystem->deleteDir($dirname);
    }
}