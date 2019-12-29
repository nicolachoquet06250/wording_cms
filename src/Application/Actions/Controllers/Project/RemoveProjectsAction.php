<?php


namespace App\Application\Actions\Controllers\Project;


use Psr\Http\Message\ResponseInterface as Response;

class RemoveProjectsAction extends ProjectAction {
	protected function action(): Response {
		foreach ($this->projectRepository->findAll() as $id => $project) {
			$this->projectRepository->deleteFromId($id);
		}
		$projects = $this->projectRepository->findAll();
		return $this->respondWithData([
			'success' => (count($projects) === 0)
		]);
	}
}