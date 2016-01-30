<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
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

    /**
     * Default preparation for each test
     */
    public function setUp()
    {
        $this->prepareForTests();
        parent::setUp();
    }


    /**
     * Prepares test environment
     */
    private function prepareForTests()
    {
        /**
         * config/flysystem.php
         * -------------------------------
         * 'connections' => [
         *     'unittest' => [
         *       'driver'   => 'local',
         *       'path'       => storage_path('temp'),
         *     ],
         * ],
         */
        putenv('FILESYSTEM_DRIVER=unittest');
        putenv('MAX_FILE_SIZE=12');
    }
}
