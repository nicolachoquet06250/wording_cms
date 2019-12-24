<?php


namespace App\Application\Actions\Controllers\User;


use App\Application\Actions\Action;
use Illuminate\Support\Facades\Session;
use Psr\Http\Message\ResponseInterface as Response;

class LogoutAction extends Action {
    protected function action(): Response {
        /** @var Session $session */
        $session = $this->request->getAttribute('session');

        if($session::exists('user')) {
            $session::remove('user');
        }
        return $this->respondWithData([
            'status' => !$session::exists('user'),
        ]);
    }
}