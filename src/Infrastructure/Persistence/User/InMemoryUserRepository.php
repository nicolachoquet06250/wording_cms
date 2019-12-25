<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;
use PDO;

class InMemoryUserRepository implements UserRepository {

    /**
     * @var User[]
     */
    private $users = [];

    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
        $query = $this->db->query('SELECT `id`, `first_name`, `last_name`, `ident`, `email`, `password` FROM `user`');
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $key => $line) {
            $this->users[$key+1] = new User((int) $line['id'], $line['first_name'], $line['last_name'], $line['ident'], $line['email'], $line['password']);
        }
    }

    public function setFalseUsers(): InMemoryUserRepository {
        $this->users = [
            1 => new User(1, 'Bill', 'Gates', 'bill.gates', 'bill.gates@wcms.com', 'bill.gates'),
            2 => new User(2, 'Jobs', 'Steve', 'steve.jobs', 'steve.jobs@wcms.com', 'steve.jobs'),
            3 => new User(3, 'Zuckerberg', 'Mark', 'mark.zuckerberg', 'mark.zukerberg@wcms.com', 'mark.zukerberg'),
            4 => new User(4, 'Spiegel','Evan',  'evan.spiegel', 'evan.spiegel@wcms.com', 'evan.spiegel'),
            5 => new User(5, 'Dorsey', 'Jack', 'jack.dorsey', 'jack.dorsey@wcms.com', 'jack.dorsey'),
        ];
        return $this;
    }

    public function setFalseUser(array $user): InMemoryUserRepository {
        $this->users = array_merge($this->users, $user);
        return $this;
    }

    public function findAll(): array {
        return array_values($this->users);
    }

    public function findUserOfId(int $id): User {
        if (!isset($this->users[$id])) {
            throw new UserNotFoundException();
        }

        return $this->users[$id];
    }

	public function findByIdentAndPassword( string $ident, string $password, ?string $errorMessage = null): User {
		foreach ( $this->users as $user ) {
			if($user->getIdent() === $ident && $user->getPassword() === sha1($password)) {
				return $user;
			}
    	}
		if(is_null($errorMessage)) {
			throw new UserNotFoundException();
		}
		throw new UserNotFoundException($errorMessage);
    }
}
