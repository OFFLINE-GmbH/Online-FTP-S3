<?php

use App\Transfer\Download\DownloadTransfer;

class DownloadTransferTest extends TestCase
{
    public function testInit()
    {
        $fs     = $this->fs(function ($mock) {
            $mock->shouldReceive('cloud')->times(2)->andReturn($mock);
            $mock->shouldReceive('makeDirectory')->once()->andReturn($mock);
            $mock->shouldReceive('deleteDirectory')->once()->andReturn($mock);
            $mock->shouldReceive('listContents')->times(2)->andReturn([]);
        });
        $zipper = $this->zipper(function ($mock) {
            $mock->shouldReceive('zipDirectory')->once()->andReturn();
        });

        $transfer = new DownloadTransfer([['path' => 'a'], ['path' => 'b']], $fs, $zipper);
        $transfer->start();
    }

    protected function fs(Callable $callback)
    {
        return Mockery::mock(\Illuminate\Filesystem\FilesystemManager::class, $callback);
    }

    protected function zipper(Callable $callback)
    {
        return Mockery::mock(\App\Helpers\Zipper::class, $callback);
    }
}