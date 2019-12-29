<?php


namespace App\Application\Actions\Controllers\Project;


use App\Domain\Project\Project;
use Psr\Http\Message\ResponseInterface as Response;

class UpdateProjectAction extends ProjectAction {
	protected function action(): Response {
		$requestBody = $this->request->getBody()->getContents();
		$requestBody = json_decode($requestBody, true);
		$project = $this->projectRepository->updateProject($requestBody['id'], new Project(null, $requestBody['name'], [], $requestBody['language_code'], $requestBody['language_name']));
		$data = [
			'success' => is_null($project) ? false : true
		];
		if(is_null($project)) {
			$data['error'] = [
				'description' => 'Une erreur est survenue lors de la modification du projet, veuillez reésseiller ulterieurement.'
			];
		}
		else {
			$data['project'] = $project;
		}
		return $this->respondWithData($data);
	}
}