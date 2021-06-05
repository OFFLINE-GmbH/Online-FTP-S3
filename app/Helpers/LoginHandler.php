<?php

namespace App\Helpers;


use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class LoginHandler
{
    public function set($data)
    {
        Session::set('data', Crypt::encrypt($data));

        return $this;
    }

    public function apply($data = null)
    {
        $data = $data ?? Crypt::decrypt(Session::get('data'));
        $driver = Session::get('driver');

        if ($driver === 's3') {
            Session::put('host', sprintf('%s://%s', $data['region'], $data['bucket']));
            config()->set('filesystems.cloud', 's3');
            config()->set('filesystems.disks.s3', [
                'driver' => 's3',
                'key' => $data['key'],
                'secret' => $data['secret'],
                'region' => $data['region'],
                'bucket' => $data['bucket'],
            ]);
        } elseif ($driver === 'ftp') {
            Session::put('host', sprintf('%s@%s', $data['username'], $data['host']));
            config()->set('filesystems.cloud', 'ftp');
            config()->set('filesystems.disks.ftp', [
                'driver' => 'ftp',
                'host' => $data['host'],
                'username' => $data['username'],
                'password' => $data['password'],
                'port' => $data['port'],
            ]);
        } else {
            throw new \RuntimeException('Unknown driver');
        }
    }
}
