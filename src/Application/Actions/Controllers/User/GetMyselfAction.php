<?php


namespace App\Application\Actions\Controllers\User;


use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class GetMyselfAction extends Action {
    protected function action(): Response {
        $this->response->getBody()->write('Hello World !!');
        return $this->response;
    }
}