<?php

use App\Repositories\DirectoryRepository;
use App\Repositories\FileRepository;
use Illuminate\Filesystem\FilesystemManager;
use Mockery;


class FileRepositoryTest extends TestCase
{
    public function testContents()
    {
        $fs   = Mockery::mock(FilesystemManager::class, function ($mock) {
            $mock->shouldReceive('read')->once()->andReturn('file contents');
        });
        $repo = new FileRepository($fs);
        $this->assertEquals($repo->contents('/'), 'file contents');
    }

    public function tearDown()
    {
        Mockery::close();
    }

}
