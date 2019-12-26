<?php


namespace App\Application\Actions\Controllers\Account;


use App\Application\Actions\Action;
use Illuminate\View\Factory;
use Psr\Http\Message\ResponseInterface as Response;

class AccountAction extends Action {

    protected function action(): Response {
        /** @var Factory $template */
        $template = $this->request->getAttribute('template')->view();
        $body = $template->make('account')->render();
        $this->response->getBody()->write($body);
        return $this->response;
    }
}