<?php

use App\Repositories\DirectoryRepository;
use Illuminate\Support\Facades\App;

class DirectoryControllerTest extends TestCase
{
    public function testIndex()
    {
        $this->getRepo(function ($mock) {
            $mock->shouldReceive('listing')
                 ->once()
                 ->andReturn($this->dummyListing());
        });

        $this->call('GET', '/directory');
        $this->seeStatusCode(200);
        $this->assertEquals($this->response->getContent(), json_encode([
            'listing' => $this->dummyListing(),
        ]));
    }

    public function testIndexWithPath()
    {
        $this->getRepo(function ($mock) {
            $mock->shouldReceive('listing')
                 ->once()
                 ->with('path/to/file')
                 ->andReturn($this->dummyListing());
        });

        $this->call('GET', '/directory?path=path/to/file');
        $this->seeStatusCode(200);
        $this->assertEquals($this->response->getContent(), json_encode([
            'listing' => $this->dummyListing(),
        ]));
    }

    public function testCreate()
    {
        $path = 'dir/subdir';

        $this->getRepo(function ($mock) use ($path) {
            $mock->shouldReceive('create')
                 ->once()
                 ->with($path)
                 ->andReturn(true);
        });

        $this->call('POST', '/directory/', ['path' => $path]);
        $this->seeStatusCode(201);

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

        $this->call('DELETE', '/directory/', ['path' => $delete]);
        $this->seeStatusCode(200);

        $this->assertJson(json_encode(['success' => true]));
    }


    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @return \Mockery\MockInterface
     */
    protected function getRepo(Callable $callback)
    {
        $repo = Mockery::mock(DirectoryRepository::class, $callback);

        App::instance(DirectoryRepository::class, $repo);

        return $repo;
    }

}
