<?php


namespace App\Application\Actions\Controllers\User;


use App\Application\Actions\Action;
use App\Domain\User\UserNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;

class GetMyselfAction extends Action {
    protected function action(): Response {
    	if($this->session->has('user')) {
		    return $this->respondWithData([
		        'user' => $this->session->getValue('user')
            ]);
	    } else {
		    throw new UserNotFoundException('Vous n\'êtes pas connecté !');
	    }
    }
}