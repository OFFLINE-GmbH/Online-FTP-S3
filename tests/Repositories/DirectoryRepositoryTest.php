<?php

use App\Repositories\DirectoryRepository;
use Illuminate\Filesystem\FilesystemManager;

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
}
