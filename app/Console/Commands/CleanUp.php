<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\FilesystemManager;

class CleanUp extends Command
{
    /**
     * @var int
     */
    const FIFTEEN_MINUTES = 900;

    /**
     * Never delete these files.
     * @var array
     */
    private $ignore = ['.gitignore'];
    /**
     * Cleanup these storage directories
     * @var array
     */
    private $dirs = ['downloads', 'uploads'];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'onlineftp:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans up temporary files';

    /**
     * @var FilesystemManager
     */
    private $fs;

    /**
     * Create a new command instance.
     *
     * @param FilesystemManager $fs
     */
    public function __construct(FilesystemManager $fs)
    {
        parent::__construct();
        $this->fs = $fs;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->dirs as $directory) {
            $this->cleanup($directory);
        }
    }

    /**
     * Removes old files from a directory.
     *
     * @param $path
     */
    protected function cleanup($path)
    {
        foreach ($this->fs->directories($path) as $directory) {
            if ( ! $this->keep($directory)) {
                $this->fs->deleteDirectory($directory);
            }
        }

        foreach ($this->fs->files($path) as $file) {
            if ( ! $this->keep($file)) {
                $this->fs->delete($file);
            }
        }
    }

    /**
     * Checks if a file should be ignored.
     *
     * @param $file
     *
     * @return bool
     */
    private function ignore($file)
    {
        $parts = explode('/', $file);

        return in_array(array_pop($parts), $this->ignore);
    }

    /**
     * Checks if a file should be deleted.
     *
     * @param $file
     *
     * @return bool
     */
    protected function isOld($file)
    {
        $modified = $this->fs->lastModified($file);

        return $modified < (time() - $this::FIFTEEN_MINUTES);
    }

    /**
     * Test if file should be ignored or is not yet old
     * enough to be deleted.
     *
     * @param $path
     *
     * @return bool
     */
    protected function keep($path)
    {
        return $this->ignore($path) || ! $this->isOld($path);
    }
}
