<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\FilesystemManager;

class CleanUp extends Command
{
    /**
     * @var int
     */
    const FIFTEEN_MINUTES = 1800;

    /**
     * Never delete these files.
     * @var array
     */
    private $ignore = ['.gitignore'];

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
        foreach ($this->fs->files('downloads') as $file) {
            if ($this->ignore($file) || ! $this->isOld($file)) {
                continue;
            }

            $this->fs->delete($file);
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
}
