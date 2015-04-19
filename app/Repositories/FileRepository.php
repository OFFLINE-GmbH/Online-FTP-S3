<?php namespace App\Repositories;

use Anchu\Ftp\Facades\Ftp;

class FileRepository
{
    /**
     * @var \Anchu\Ftp\Ftp;
     */
    private $ftp;

    function __construct()
    {
        $this->ftp = FTP::connection(getenv('FTP_SERVER'));
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
        return $this->ftp->readFile($filename);
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
        $tmpFile = tempnam(sys_get_temp_dir(), 'onlineftp');

        if ($tmpFile === false) return false;
        if (file_put_contents($tmpFile, $contents) === false) return false;
        if ($this->ftp->uploadFile($tmpFile, $filename) === false) return false;

        unlink($tmpFile);

        return true;
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
        return $this->ftp->delete($filename);
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