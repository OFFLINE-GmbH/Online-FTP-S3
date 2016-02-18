<?php

use App\Repositories\DirectoryRepository;
use Illuminate\Filesystem\FilesystemManager;
use Mockery;


class DirectoryRepositoryTest extends TestCase
{
    public function testListing()
    {
        $fs   = Mockery::mock(FilesystemManager::class, function ($mock) {
            // Listing should get resorted
            $reverseListing = array_reverse($this->dummyListing());
            $mock->shouldReceive('listContents')->once()->andReturn($reverseListing);
        });
        $repo = new DirectoryRepository($fs);
        $this->assertEquals($repo->listing('/'), $this->dummyListing());
    }

    public function tearDown()
    {
        Mockery::close();
    }

    private function dummyListing()
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
                'size'       => 30,
                'dirname'    => '',
                'basename'   => 'fileA.txt',
                'extension'  => 'txt',
                'filename'   => 'fileA',
            ],
            [
                'type'       => 'file',
                'path'       => 'fileB.txt',
                'visibility' => 'public',
                'size'       => 30,
                'dirname'    => '',
                'basename'   => 'fileB.txt',
                'extension'  => 'txt',
                'filename'   => 'fileB',
            ],
        ];
    }

}
