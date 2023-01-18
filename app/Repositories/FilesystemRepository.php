<?php

namespace App\Repositories;


use Illuminate\Filesystem\FilesystemManager;

class FilesystemRepository
{
    protected $fs;

    public function __construct(FilesystemManager $fs)
    {
        $this->fs = $fs;
    }
}
