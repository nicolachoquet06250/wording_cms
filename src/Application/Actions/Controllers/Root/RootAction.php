<?php


namespace App\Application\Actions\Controllers\Root;


use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\View\Factory;

class RootAction extends Action {
    protected function action(): Response {
        /** @var Factory $template */
        $template = $this->request->getAttribute('template')->view();
        $body = $template->make('index')->render();
        $this->response->getBody()->write($body);
        return $this->response;
    }
}