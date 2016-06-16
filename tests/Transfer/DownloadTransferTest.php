<?php

use App\Transfer\Download\DownloadTransfer;

class DownloadTransferTest extends TestCase
{
    public function testInit()
    {
        $fs = $this->fs(function ($mock)  {
            $mock->shouldReceive('drive')->with('local')->andReturn($mock);
            $mock->shouldReceive('makeDirectory')->once()->andReturn($mock);
        });

        $download = new DownloadTransfer(['a', 'b'], $fs);
        
    }
    
    protected function fs(Callable $callback) {
        return Mockery::mock(\Illuminate\Filesystem\FilesystemManager::class, $callback);
    }
}