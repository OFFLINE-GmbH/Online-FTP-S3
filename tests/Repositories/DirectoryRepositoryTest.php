<?php

use App\Repositories\DirectoryRepository;
use Illuminate\Filesystem\FilesystemManager;

class DirectoryRepositoryTest extends TestCase
{
    public function testListing()
    {
        $repo = $this->getRepo(function ($mock) {
            // Listing should get resorted
            $reverseListing = array_reverse($this->dummyListing());
            $mock->shouldReceive('listContents')->once()->andReturn($reverseListing);
        });
        $this->assertEquals($repo->listing('/'), $this->dummyListing());
    }

    public function testDelete()
    {
        $delete = ['a', 'b', 'c'];
        $repo   = $this->getRepo(function ($mock) use ($delete) {
            $mock->shouldReceive('deleteDir')->times(count($delete))->andReturn(true);
        });

        $this->assertTrue($repo->delete($delete));
    }

    public function testCreate()
    {
        $repo = $this->getRepo(function ($mock) {
            $mock->shouldReceive('createDir')->once()->andReturn(true);
        });

        $this->assertTrue($repo->create('dir/subdir'));
    }

    /**
     * @return \Mockery\MockInterface
     */
    protected function getRepo(Callable $callback)
    {
        $fs = Mockery::mock(FilesystemManager::class, $callback);
        $fs->shouldReceive('cloud')->andReturn($fs);

        return new DirectoryRepository($fs);
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
