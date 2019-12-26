<?php


namespace App\Application\Interfaces;


use App\Domain\User\User;

interface Login {
    public function sessionIs(Session $session): Login;
    public function check(): bool ;
    public function login(User $user): array;
    public function logout(): array;
    public function getUser(): ?User;
}