<?php

namespace App\Http\Controllers;

use App\Helpers\LoginHandler;
use App\Http\Requests;
use Aws\S3\Exception\S3Exception;
use Illuminate\Filesystem\FilesystemManager;
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
        $data = $this->getData($request);
        $this->session->set('driver', $request->get('driver', 'ftp'));

        $login = new LoginHandler();
        $login->set($data)->apply();

        try {
            // Try to list contents to validate the provided data.
            $fs->cloud()->files('/');
        } catch (\Expection $e) {
            return $this->error($e);
        } catch (\ErrorException $e) {
            return $this->error($e);
        } catch (S3Exception $e) {
            return $this->error($e);
        } catch (\RuntimeException $e) {
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
                    'host'     => $request->get('host'),
                    'username' => $request->get('username'),
                    'password' => $request->get('password'),
                    'port'     => $request->get('port', 21),
                ];
            case 's3':
                return [
                    'key'    => $request->get('key'),
                    'secret' => $request->get('secret'),
                    'region' => $request->get('region'),
                    'bucket' => $request->get('bucket'),
                ];
        }
    }
}
