<?php

namespace App\Http\Controllers;

use App\Helpers\LoginHandler;
use App\Http\Requests;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Session;
use Throwable;

class SessionController extends Controller
{
    public function login(Requests\LoginRequest $request, FilesystemManager $fs)
    {
        $data = $this->getData($request);
        Session::put('driver', $request->get('driver', 'ftp'));

        $login = new LoginHandler();
        $login->set($data)->apply($data);

        try {
            // Try to list contents to validate the provided data.
            $fs->cloud()->files('/');
        } catch (Throwable $e) {
            return $this->error($e);
        }

        Session::put('loggedIn', true);

        return redirect('/');
    }

    public function logout()
    {
        Session::flush();
        Session::regenerate();

        return redirect('/');
    }

    protected function error($e)
    {
        info('login failed', [$e]);
        return redirect()->back()->withErrors(['connection' => 'Cannot connect to server!'])->withInput();
    }

    /**
     * @param Requests\LoginRequest $request
     *
     * @return array
     */
    protected function getData(Requests\LoginRequest $request)
    {
        switch ($request->get('driver')) {
            case 'ftp':
                return [
                    'host' => $request->get('host'),
                    'username' => $request->get('username'),
                    'password' => $request->get('password'),
                    'port' => $request->get('port', 21),
                ];
            case 's3':
                return [
                    'key' => $request->get('key'),
                    'secret' => $request->get('secret'),
                    'region' => $request->get('region'),
                    'bucket' => $request->get('bucket'),
                ];
        }
    }
}
