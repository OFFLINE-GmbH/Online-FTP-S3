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
        $data = \Crypt::decrypt(\Session::get('data'));
        app()['config']['filesystems.disks.ftp'] = [
            'driver'   => 'ftp',
            'host'     => $data['host'],
            'username' => $data['username'],
            'password' => $data['password'],

            // Optional FTP Settings...
            'port'     => $data['port'],
            // 'root'     => '',
            // 'passive'  => true,
            // 'ssl'      => true,
            // 'timeout'  => 30,
        ];
    }
}