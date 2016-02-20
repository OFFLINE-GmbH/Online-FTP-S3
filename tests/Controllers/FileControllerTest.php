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
        $this->assertEquals($this->response->getContent(), json_encode([
            'contents' => 'xyz'
        ]));
    }


    public function testUpdate()
    {
        $repo = $this->getRepo(function ($mock) {
            $mock->shouldReceive('update')
                 ->once()
                 ->with('/file.php', 'new contents')
                 ->andReturn(true);
        });

        App::instance(FileRepository::class, $repo);

        $this->call('PUT', '/file/?path=/file.php', ['contents' => 'new contents']);
        $this->seeStatusCode(200);

        $this->assertJson(json_encode(['success' => true]));
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
