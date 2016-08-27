<?php

namespace App\Repositories;


use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Config;
use League\Flysystem\Plugin\ListPaths;
use League\Flysystem\Plugin\ListWith;

class FilesystemRepository
{
    protected $fs;

    public function __construct(FilesystemManager $fs)
    {
        $this->fs = $fs;
    }
}