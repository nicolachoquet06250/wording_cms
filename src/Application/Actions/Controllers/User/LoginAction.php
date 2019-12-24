<?php


namespace App\Application\Actions\Controllers\User;


use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class LoginAction extends Action {
    protected function action(): Response {
        $requestBody = json_decode($this->request->getBody()->getContents(), true);
        $this->respondWithData($requestBody);
        return $this->response;
    }
}