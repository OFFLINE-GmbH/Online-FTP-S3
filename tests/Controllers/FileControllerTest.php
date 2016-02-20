<?php

use App\Repositories\FileRepository;
use Illuminate\Support\Facades\App;

class FileControllerTest extends TestCase
{
    public function testShow()
    {
        $repo = $this->getRepo(function ($mock) {
            $mock->shouldReceive('contents')
                 ->once()
                 ->andThrow(\InvalidArgumentException::class);
        });

        App::instance(FileRepository::class, $repo);

        $this->call('GET', '/file/');
        $this->seeStatusCode(500);
    }

    public function testShowWithPath()
    {
        $repo = $this->getRepo(function ($mock) {
            $mock->shouldReceive('contents')
                 ->once()
                 ->with('path/to/file')
                 ->andReturn('xyz');
        });

        App::instance(FileRepository::class, $repo);

        $this->call('GET', '/file/?path=path/to/file');
        $this->seeStatusCode(200);

        $this->assertEquals($this->response->getContent(), 'xyz');
    }


    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @param callable $callback
     *
     * @return \Mockery\MockInterface
     */
    protected function getRepo(Callable $callback)
    {
        $repo = Mockery::mock(FileRepository::class, $callback);

        return $repo;
    }

}
