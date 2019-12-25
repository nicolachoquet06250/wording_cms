<?php


namespace App\Application\Actions\Controllers\User;


use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class LogoutAction extends Action {
    protected function action(): Response {
        if($this->session->has('user')) {
            $this->session->unsetValue('user');
        }
        return $this->respondWithData([
            'status' => !$this->session->has('user'),
        ]);
    }
}