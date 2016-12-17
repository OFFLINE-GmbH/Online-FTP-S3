<?php

namespace App\Helpers;


class LoginHandler
{
    public function set($data)
    {
        $data = \Crypt::encrypt($data);
        \Session::set('data', $data);

        return $this;
    }

    public function apply()
    {
        $data   = \Crypt::decrypt(\Session::get('data'));
        $driver = \Session::get('driver');

        if ($driver === 's3') {
            app()['config']['filesystems.cloud']    = 's3';
            app()['config']['filesystems.disks.s3'] = [
                'driver' => 's3',
                'key'    => $data['key'],
                'secret' => $data['secret'],
                'region' => $data['region'],
                'bucket' => $data['bucket'],
            ];
        } elseif ($driver === 'ftp') {
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