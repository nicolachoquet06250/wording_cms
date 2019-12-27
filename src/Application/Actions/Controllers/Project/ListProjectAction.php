<?php


namespace App\Application\Actions\Controllers\Project;


use Psr\Http\Message\ResponseInterface as Response;

class ListProjectAction extends ProjectAction {
    protected function action(): Response {
        return $this->response;
    }
}