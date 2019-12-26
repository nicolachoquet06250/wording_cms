<?php
declare(strict_types=1);

namespace App\Application\Actions\Controllers\User;

use App\Application\Actions\Action;
use App\Application\Interfaces\Login;
use App\Application\Interfaces\Session;
use App\Domain\User\UserRepository;
use Psr\Log\LoggerInterface;

abstract class UserAction extends Action {
    protected UserRepository $userRepository;

    public function __construct(LoggerInterface $logger, UserRepository $userRepository, Session $session, Login $login) {
        parent::__construct($logger, $session, $login);
        $this->userRepository = $userRepository;
    }
}
