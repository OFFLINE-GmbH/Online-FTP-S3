<?php namespace App\Repositories;

use Anchu\Ftp\Facades\Ftp;
use GrahamCampbell\Flysystem\FlysystemManager;

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
     * @param      $dirname
     *
     * @param bool $recursive
     *
     * @return array
     */
    function get($dirname, $recursive = false)
    {
        $contents = $this->flysystem->listContents(rawurldecode($dirname), $recursive);
        // Sort by type
        usort($contents, function ($a, $b) {
            return strcmp($a['type'], $b['type']);
        });
        return $contents;
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
        return $this->flysystem->createDir(rawurldecode($dirname));
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
        return $this->flysystem->rename(rawurldecode($from), $to);
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
        return $this->flysystem->deleteDir(rawurldecode($dirname));
    }
}