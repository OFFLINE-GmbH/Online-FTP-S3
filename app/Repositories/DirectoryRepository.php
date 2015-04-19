<?php namespace App\Repositories;

use Anchu\Ftp\Facades\Ftp;

class DirectoryRepository
{
    /**
     * @var \Anchu\Ftp\Ftp;
     */
    private $ftp;

    function __construct()
    {
        $this->ftp = Ftp::connection(getenv('FTP_SERVER'));
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
        return $this->ftp->getDirListingDetailed($dirname);
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
        return $this->ftp->makeDir($dirname);
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
        return $this->ftp->rename($from, $to);
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
        return $this->ftp->removeDir($dirname);
    }
}