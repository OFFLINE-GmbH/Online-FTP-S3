<?php
namespace App\Repositories;

class DirectoryRepository extends FilesystemRepository
{
    public function listing($path = '/')
    {
        $contents = $this->fs->cloud()->listContents($path);
        $contents = $this->sortForListing($contents);
        $contents = $this->formatFileSize($contents);

        return $contents;
    }

    public function delete($path)
    {
        if ( ! is_array($path)) {
            $path = [$path];
        }

        foreach ($path as $dir) {
            $this->fs->cloud()->deleteDir($dir);
        }

        return true;
    }

    /**
     * Creates an empty directory
     *
     * @param $path
     *
     * @return bool
     */
    public function create($path)
    {
        return $this->fs->cloud()->createDir($path);
    }

    /**
     * Sort the listing by type and filename.
     *
     * @param $contents
     *
     * @return array
     */
    protected function sortForListing($contents)
    {
        usort($contents, function ($a, $b) {
            // Sort by type
            $c = strcmp($a['type'], $b['type']);
            if ($c !== 0) {
                return $c;
            }

            // Sort by name
            return strcmp($a['filename'], $b['filename']);
        });

        return $contents;
    }

    /**
     * Format the filesize human readable.
     *
     * @param $contents
     *
     * @return array
     */
    protected function formatFileSize($contents)
    {
        return array_map(function ($item) {
            if (isset($item['size'])) {
                $item['size'] = $this->formatBytes($item['size']);
            }

            return $item;
        }, $contents);
    }

    /**
     * Format bytes as human readable filesize.
     *
     * @param     $size
     *
     * @param int $precision
     *
     * @return string
     */
    public function formatBytes($size, $precision = 2)
    {
        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        } else {
            return $size . ' bytes';
        }
    }
}