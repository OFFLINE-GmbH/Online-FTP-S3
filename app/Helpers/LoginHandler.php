<?php

namespace App\Helpers;


use Crypt;
use Illuminate\Support\Facades\Session;

class LoginHandler
{
    public function set($data)
    {
        $data = Crypt::encrypt($data);
        \Session::set('data', $data);

        return $this;
    }

    public function apply()
    {
        $data   = Crypt::decrypt(Session::get('data'));
        $driver = Session::get('driver');

        if ($driver === 's3') {
            Session::set('host', sprintf('%s://%s', $data['region'], $data['bucket']));
            app()['config']['filesystems.cloud']    = 's3';
            app()['config']['filesystems.disks.s3'] = [
                'driver' => 's3',
                'key'    => $data['key'],
                'secret' => $data['secret'],
                'region' => $data['region'],
                'bucket' => $data['bucket'],
            ];
        } elseif ($driver === 'ftp') {
            Session::set('host', sprintf('%s@%s', $data['username'], $data['host']));
            app()['config']['filesystems.cloud']     = 'ftp';
            app()['config']['filesystems.disks.ftp'] = [
                'driver'   => 'ftp',
                'host'     => $data['host'],
                'username' => $data['username'],
                'password' => $data['password'],
                'port'     => $data['port'],
            ];
        } else {
            throw new \RuntimeException('Unknown driver');
        }

    }
}