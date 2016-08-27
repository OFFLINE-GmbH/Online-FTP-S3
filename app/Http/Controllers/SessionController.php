<?php

namespace App\Http\Controllers;

use App\Helpers\LoginHandler;
use App\Http\Requests;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Session\SessionInterface;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    /**
     * @var Session
     */
    private $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function login(Requests\LoginRequest $request, FilesystemManager $fs)
    {
        $data = [
            'host'     => $request->get('host'),
            'username' => $request->get('username'),
            'password' => $request->get('password'),
            'port'     => $request->get('port', 21),
        ];

        $login = new LoginHandler();
        $login->set($data)->apply();

        try {
            // Try to list contents to validate the provided data.
            $fs->cloud()->files('/');
        } catch (\Expection $e) {
            return $this->error($e);
        } catch (\ErrorException $e) {
            return $this->error($e);
        }

        $this->session->set('loggedIn', true);

        return redirect('/');
    }

    public function logout()
    {
        $this->session->flush();
        $this->session->regenerate();

        return redirect('/');
    }

    protected function error($e)
    {
        return redirect()->back()->withErrors('Could not connect to server');
    }
}
