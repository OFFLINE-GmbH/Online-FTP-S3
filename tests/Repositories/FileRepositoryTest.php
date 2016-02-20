<?php

use App\Repositories\FileRepository;
use Illuminate\Filesystem\FilesystemManager;


class FileRepositoryTest extends TestCase
{
    public function testContents()
    {
        $repo = $this->getRepo(function ($mock) {
            $mock->shouldReceive('read')->once()->andReturn('file contents');
        });

        $this->assertEquals($repo->contents('/'), 'file contents');
    }

    public function testContentsWithoutPath()
    {
        $repo = $this->getRepo(function ($mock) {
            $mock->shouldReceive('read')->never();
        });

        $this->setExpectedException(\InvalidArgumentException::class);

        $repo->contents(''); // no path
    }

    public function testUpdate()
    {
        $repo = $this->getRepo(function ($mock) {
            $mock->shouldReceive('put')->once()->with('/file.php', 'new contents')->andReturn(true);
        });

        $this->assertEquals($repo->update('/file.php', 'new contents'), true);
    }

    /**
     * @return \Mockery\MockInterface
     */
    protected function getRepo(Callable $callback)
    {
        $fs = Mockery::mock(FilesystemManager::class, $callback);

        return new FileRepository($fs);
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
