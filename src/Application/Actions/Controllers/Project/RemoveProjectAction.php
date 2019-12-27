<?php


namespace App\Application\Actions\Controllers\Project;


use App\Domain\Project\ProjectNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;

class RemoveProjectAction extends ProjectAction {
    protected function action(): Response {
        $requestBody = $this->request->getBody()->getContents();
        $requestBody = json_decode($requestBody, true);
        $id = (int) $requestBody['id'];
        if($this->projectRepository->deleteFromId($id)) {
            return $this->respondWithData([
                'success' => true
            ]);
        } else {
            return $this->respondWithData([
                'success' => false,
                'error' => [
                    'description' => 'Le projet n\'à pas pu être supprimé, veuillez réessayer ulterieurement !'
                ]
            ]);
        }
    }
}