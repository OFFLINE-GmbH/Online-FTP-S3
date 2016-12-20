<?php

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }


    protected function dummyListing()
    {
        return [
            [
                'type'     => 'dir',
                'path'     => 'Directory A',
                'dirname'  => '',
                'basename' => 'Directory A',
                'filename' => 'Directory A',
            ],
            [
                'type'       => 'file',
                'path'       => 'fileA.txt',
                'visibility' => 'public',
                'size'       => '30 bytes',
                'dirname'    => '',
                'basename'   => 'fileA.txt',
                'extension'  => 'txt',
                'filename'   => 'fileA',
            ],
            [
                'type'       => 'file',
                'path'       => 'fileB.txt',
                'visibility' => 'public',
                'size'       => '30 bytes',
                'dirname'    => '',
                'basename'   => 'fileB.txt',
                'extension'  => 'txt',
                'filename'   => 'fileB',
            ],
        ];
    }

}
