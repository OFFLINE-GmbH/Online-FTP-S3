<?php
namespace App\Repositories;

class DirectoryRepository extends BaseRepository
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
}