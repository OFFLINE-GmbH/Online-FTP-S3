<?php

namespace App\Tools;


use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class Zipper
{
    private $zip;

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
            // Skip directories (they would be added automatically)
            if ($file->isDir()) {
                continue;
            }

            $filePath     = $file->getRealPath();
            $relativePath = substr($filePath, strlen($rootPath) + 1);

            $this->zip->addFile($filePath, $relativePath);
        }
    }
}