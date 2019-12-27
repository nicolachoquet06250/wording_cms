<?php


namespace App\Application\Actions\Controllers\User;


use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;

class SignupAction extends UserAction {
    protected function action(): Response {
        $requestBody = json_decode($this->request->getBody()->getContents(), true);
        $inserted_id = $this->userRepository->add(new User(null, $requestBody['first_name'], $requestBody['last_name'], $requestBody['ident'], $requestBody['email'], sha1($requestBody['password'])));
        if(is_int($inserted_id)) {
            return $this->respondWithData([
                'user' => $this->userRepository->findUserOfId($inserted_id)
            ]);
        }
        throw new UserNotFoundException('Une erreur est survenu lors de l\'inscription, veuillez réesseiller ulterieurement !');
    }
}