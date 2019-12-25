<?php


namespace App\Application\Actions\Controllers\User;


use Psr\Http\Message\ResponseInterface as Response;

class LoginAction extends UserAction {
    protected function action(): Response {
        $requestBody = json_decode($this->request->getBody()->getContents(), true);
		$user = $this->userRepository->findByIdentAndPassword($requestBody['ident'], $requestBody['password'], 'Les identifiants utilisés ne correspondent pas!');
		if($this->session->has('user')) {
			$user = [
				'redirect' => '/',
			];
		} else {
			$this->session->setValue('user', $user);
			$user = [
				'user' => $user,
			];
		}
		return $this->respondWithData($user);
    }
}