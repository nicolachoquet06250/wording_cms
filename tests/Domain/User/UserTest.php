<?php
declare(strict_types=1);

namespace Tests\Domain\User;

use App\Domain\User\User;
use Tests\TestCase;

class UserTest extends TestCase {
    public function userProvider() {
        return [
            [1, 'Bill', 'Gates', 'bill.gates', 'bill.gates@wcms.com', 'bill.gates'],
            [2, 'Steve', 'Jobs', 'steve.jobs', 'steve.jobs@wcms.com', 'steve.jobs'],
            [3, 'Mark', 'Zuckerberg', 'mark.zuckerberg', 'mark.zukerberg@wcms.com', 'mark.zukerberg'],
            [4, 'Evan', 'Spiegel',  'evan.spiegel', 'evan.spiegel@wcms.com', 'evan.spiegel'],
            [5, 'Jack', 'Dorsey', 'jack.dorsey', 'jack.dorsey@wcms.com', 'jack.dorsey'],
        ];
    }

    /**
     * @dataProvider userProvider
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param string $ident
     * @param string $email
     * @param string $password
     */
    public function testGetters(int $id, string $firstName, string $lastName, string $ident, string $email, string $password) {
        $user = new User($id, $firstName, $lastName, $ident, $email, $password);

        $this->assertEquals($id, $user->getId());
        $this->assertEquals($ident, $user->getIdent());
        $this->assertEquals($firstName, $user->getFirstName());
        $this->assertEquals($lastName, $user->getLastName());
    }

    /**
     * @dataProvider userProvider
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param string $ident
     * @param string $email
     * @param string $password
     */
    public function testJsonSerialize(int $id, string $firstName, string $lastName, string $ident, string $email, string $password) {
        $user = new User($id, $firstName, $lastName, $ident, $email, $password);

        $expectedPayload = json_encode([
            'id' => $id,
            'ident' => $ident,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email
        ]);

        $this->assertEquals($expectedPayload, json_encode($user));
    }
}
