<?php

class TestCase extends Laravel\Lumen\Testing\TestCase
{

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__ . '/../bootstrap/app.php';
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
