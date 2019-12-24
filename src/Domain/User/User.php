<?php
declare(strict_types=1);

namespace App\Domain\User;

use JsonSerializable;

class User implements JsonSerializable {
    private ?int $id = null;

    private string $first_name;

    private string $last_name;

    private string $ident;

    private ?string $password = null;

    private string $email;

    public function __construct(?int $id, string $first_name, string $last_name, string $ident, string $email, ?string $password = null) {
        $this->id = $id;
        $this->email = strtolower(trim($email));
        $this->last_name = ucfirst(trim($last_name));
        $this->first_name = ucfirst(trim($first_name));
        $this->ident = strtolower(trim($ident));
        if(!is_null($password)) {
            $this->password = trim($password);
        }
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getFirstName(): string {
        return $this->first_name;
    }

    public function getLastName(): string {
        return $this->last_name;
    }

    public function getIdent(): string {
        return $this->ident;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function jsonSerialize(): array {
        return [
            'id' => $this->getId(),
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            'ident' => $this->getIdent(),
            'email' => $this->getEmail(),
        ];
    }
}
