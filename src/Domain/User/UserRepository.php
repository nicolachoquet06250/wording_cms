<?php
declare(strict_types=1);

namespace App\Domain\User;

use PDO;

interface UserRepository {

    public function __construct(PDO $db);

    /**
     * @return User[]
     */
    public function findAll(): array ;

    /**
     * @param int $id
     *
     * @return User
     * @throws UserNotFoundException
     */
    public function findUserOfId(int $id): User;

	/**
	 * @param string $ident
	 * @param string $sha1
	 * @param string $errorMessage
	 *
	 * @return User
	 * @throws UserNotFoundException
	 */
	public function findByIdentAndPassword( string $ident, string $sha1, ?string $errorMessage = null): User;

    /**
     * @param User $user
     *
     * @return int|null
     */
	public function add(User $user): ?int;
}
