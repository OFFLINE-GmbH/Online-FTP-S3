<?php

namespace App\Repositories;


use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Config;

class BaseRepository
{
    protected $fs;

    public function __construct(FilesystemManager $fs)
    {
        Config::set('filesystems.default', 'ftp');
        $this->fs = $fs;
    }
}