<?php

use App\Transfer\Upload\UploadTransfer;

class UploadTransferTest extends TestCase
{
    public function testInit()
    {
        \Storage::shouldReceive('get')
                ->once()
                ->andReturn('contents');

        $fs     = $this->fs(function ($mock) {
            $mock->shouldReceive('cloud')->once()->andReturn($mock);
            $mock->shouldReceive('files')->once()->andReturn(['test.jpg']);
            $mock->shouldReceive('directories')->once()->andReturn([]);
            $mock->shouldReceive('makeDirectory')->never();
            $mock->shouldReceive('deleteDirectory')->once()->andReturn($mock);
            $mock->shouldReceive('put')->once()->andReturn($mock);
        });

        $zipper = $this->zipper(function ($mock) {
        });

        $file   = $this->file(function ($mock) {
            $mock->shouldReceive('getClientOriginalName')->once()->andReturn('test.jpg');
            $mock->shouldReceive('move')->once();
        });

        $transfer = new UploadTransfer([$file], '/path/', $fs, $zipper);
        $transfer->start(false);
    }

    protected function fs(Callable $callback)
    {
        return Mockery::mock(\Illuminate\Filesystem\FilesystemManager::class, $callback);
    }

    protected function zipper(Callable $callback)
    {
        return Mockery::mock(\App\Helpers\Zipper::class, $callback);
    }

    protected function file(Callable $callback)
    {
        return Mockery::mock(\Illuminate\Http\UploadedFile::class, $callback);
    }

    protected function storage(Callable $callback)
    {
        return Mockery::mock(\Illuminate\Filesystem\Filesystem::class, $callback);
    }
}