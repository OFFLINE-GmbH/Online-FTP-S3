<?php

namespace App\Helpers;


use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class Zipper
{
    private $zip;

    public function unzip($path, $target)
    {
        $this->zip = new \ZipArchive();
        $res       = $this->zip->open($path);

        if ($res === true) {
            $this->zip->extractTo($target);
            $this->zip->close();

            return $target;
        } else {
            throw new \RuntimeException('Failed to extract zip archive.');
        }
    }

    public function zipDirectory($path, $zipPath)
    {
        $this->zip = new \ZipArchive();
        $this->zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $this->addFilesToZip($path);

        $this->zip->close();

        if ( ! file_exists($zipPath)) {
            throw new \RuntimeException('Failed to create zip archive.');
        }
    }

    /**
     * Add files to zip archive recursively.
     *
     * @param $rootPath
     */
    protected function addFilesToZip($rootPath)
    {
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            // Skip directories (they will be added automatically)
            if ($file->isDir()) {
                continue;
            }

            $filePath     = $file->getRealPath();
            $relativePath = substr($filePath, strlen($rootPath) + 1);

            $this->zip->addFile($filePath, $relativePath);
        }
    }

}