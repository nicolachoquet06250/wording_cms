<?php


namespace App\Application\Dependencies;


use App\Application\Interfaces\Session;
use App\Domain\User\User;

class Login implements \App\Application\Interfaces\Login {
    protected Session $session;

    public function sessionIs(Session $session): \App\Application\Interfaces\Login {
        $this->session = $session;
        return $this;
    }

    public function check(): bool {
        return $this->session->has('user');
    }

    public function login(User $user): array {
        $this->session->setValue('user', $user->jsonSerialize());
        $success = $this->check();
        return [
            'success' => $success,
            'description' => $success ? 'success' : 'Une erreur est survenu lors de l\'authentification !',
        ];
    }

    public function logout(): array {
        $this->session->unsetValue('user');
        $success = !$this->check();
        return [
            'success' => $success,
            'description' => $success ? 'success' : 'Une erreur est survenu lors de la déconnection !',
        ];
    }

    public function getUser(): ?User {
        return $this->check() ? $this->session->getValue('user') : null;
    }
}