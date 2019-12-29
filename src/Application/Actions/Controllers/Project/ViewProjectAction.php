<?php


namespace App\Application\Actions\Controllers\Project;


use Psr\Http\Message\ResponseInterface as Response;

class ViewProjectAction extends ProjectAction {
    protected function action(): Response {
        $id = (int) $this->resolveArg('id');
        $project = $this->projectRepository->findById($id);
        return $this->respondWithData([
        	'project' => $project
        ]);
    }
}