<?php


namespace App\Application\Actions\Controllers\Project;


use App\Domain\Project\Project;
use App\Domain\Project\ProjectNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;

class AddProjectAction extends ProjectAction {
    protected function action(): Response {
        $requestBody = $this->request->getBody()->getContents();
        $requestBody = json_decode($requestBody, true);
        $project = new Project(null, $requestBody['name'], [], $requestBody['default_language_code'], $requestBody['default_language_name']);
        $project_id = $this->projectRepository->add($project);
        if(is_int($project_id)) {
            return $this->respondWithData([
                'project' => $this->projectRepository->findById($project_id),
            ]);
        }
        throw new ProjectNotFoundException('Une erreur est survenu lors de la création du projet, veuillez réesseiller ulterieurement !');
    }
}