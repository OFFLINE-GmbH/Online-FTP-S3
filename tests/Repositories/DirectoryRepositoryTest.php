<?php

use Illuminate\Filesystem\FilesystemManager;


class DirectoryRepositoryTest extends TestCase
{
    public function testListing()
    {
        $fs   = \Mockery::mock(FilesystemManager::class, function($mock) {
            $mock->shouldReceive('listContents')->once()->andReturn(['xy']);
        });
        $repo = new \App\Repositories\DirectoryRepository($fs);
        $this->assertEquals($repo->listing('/'), ['xy']);
    }

    public function tearDown()
    {
        \Mockery::close();
    }


}
