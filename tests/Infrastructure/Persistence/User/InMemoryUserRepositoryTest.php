<?php
declare(strict_types=1);

namespace Tests\Infrastructure\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use PDO;
use Tests\TestCase;

class InMemoryUserRepositoryTest extends TestCase {
    public function testFindAll() {
        $user = new User(1, 'Bill', 'Gates', 'bill.gates', 'bill.gates', 'bill.gates@wcms.com');

        $userRepository = (new InMemoryUserRepository(new PDO))->setFalseUser([1 => $user]);

        $this->assertEquals([$user], $userRepository->findAll());
    }

    public function testFindUserOfId() {
        $user = new User(1, 'Bill', 'Gates', 'bill.gates', 'bill.gates', 'bill.gates@wcms.com');

        $userRepository = (new InMemoryUserRepository(new PDO))->setFalseUser([1 => $user]);

        $this->assertEquals($user, $userRepository->findUserOfId(1));
    }

    /**
     * @expectedException \App\Domain\User\UserNotFoundException
     */
    public function testFindUserOfIdThrowsNotFoundException() {
        $userRepository = (new InMemoryUserRepository(new PDO))->setFalseUser([]);
        $userRepository->findUserOfId(1);
    }
}
