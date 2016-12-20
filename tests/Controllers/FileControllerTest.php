<?php

use App\Repositories\FileRepository;
use Illuminate\Support\Facades\App;

class FileControllerTest extends TestCase
{
    public function testShow()
    {
        $this->getRepo(function ($mock) {
            $mock->shouldReceive('contents')
                 ->once()
                 ->andThrow(\InvalidArgumentException::class);
        });

        $this->call('GET', '/file/');
        $this->seeStatusCode(500);
    }

    public function testShowWithPath()
    {
        $this->getRepo(function ($mock) {
            $mock->shouldReceive('contents')
                 ->once()
                 ->with('path/to/file')
                 ->andReturn('xyz');
        });

        $this->call('GET', '/file/?path=path/to/file');
        $this->seeStatusCode(200);
        $this->assertEquals($this->response->getContent(), json_encode([
            'contents' => 'xyz',
            'download' => false
        ]));
    }

    public function testUpdate()
    {
        $this->getRepo(function ($mock) {
            $mock->shouldReceive('update')
                 ->once()
                 ->with('/file.php', 'new contents')
                 ->andReturn(true);
        });

        $this->call('PUT', '/file/?path=/file.php', ['contents' => 'new contents']);
        $this->seeStatusCode(200);

        $this->assertJson(json_encode(['success' => true]));
    }

    public function testDelete()
    {
        $delete = ['a', 'b', 'c'];

        $this->getRepo(function ($mock) use ($delete) {
            $mock->shouldReceive('delete')
                 ->once()
                 ->with($delete)
                 ->andReturn(true);
        });

        $this->call('DELETE', '/file/', ['path' => $delete]);
        $this->seeStatusCode(200);

        $this->assertJson(json_encode(['success' => true]));
    }

    public function testCreate()
    {
        $file = 'file.txt';

        $this->getRepo(function ($mock) use ($file) {
            $mock->shouldReceive('create')
                 ->once()
                 ->with($file)
                 ->andReturn(true);
        });

        $this->call('POST', '/file/', ['path' => $file]);
        $this->seeStatusCode(201);

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

        App::instance(FileRepository::class, $repo);

        return $repo;
    }

}
