<?php
namespace App\Repositories;

class DirectoryRepository extends FilesystemRepository
{
    public function listing($path = '/')
    {
        $contents = $this->fs->listContents($path);
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

    public function delete($path)
    {
        if ( ! is_array($path)) {
            $path = [$path];
        }
        
        foreach ($path as $dir) {
            $this->fs->deleteDir($dir);
        }

        return true;
    }
}