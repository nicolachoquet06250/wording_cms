<?php
declare(strict_types=1);

namespace App\Domain\User;

use PDO;

interface UserRepository {

    public function __construct(PDO $db);

    /**
     * @return User[]
     */
    public function findAll();

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findUserOfId(int $id): User;
}
