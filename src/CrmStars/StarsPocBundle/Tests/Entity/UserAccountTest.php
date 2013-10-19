<?php

namespace CrmStars\StarsPocBundle\Tests\Entity;

use CrmStars\StarsPocBundle\Entity\UserAccount;
use CrmStars\StarsPocBundle\Service\GeneralHelperService;
use \DateTime;
use Doctrine\Tests\ORM\Tools\Export\User;

class UserAccountTest extends \PHPUnit_Framework_TestCase {

    protected $seedData;

    public function setUp() {
        parent::setUp();

        $this->seedData = array(
            'username' => GeneralHelperService::generateRandomString(20),
            'fullname' => ucfirst(GeneralHelperService::generateRandomString(10) . ' ' . GeneralHelperService::generateRandomString(10)),
            'password' => GeneralHelperService::generateRandomString(30),
            'email' => GeneralHelperService::generateRandomString(20) . '@dreamlabs.ro',
            'active' => false,
            'deleted' => false
        );
    }

    /**
     * Create a new entity using array data.
     * @param array $data The array that should be used for generating a new entity.
     * @return UserAccount The entity generated from the array data.
     */
    protected function createNewEntityFromArray($data) {
        $accountEntity = new UserAccount();

        $accountEntity
            ->setUsername($data['username'])
            ->setPassword($data['password'])
            ->setFullName($data['fullname'])
            ->setEmail($data['email'])
            ->setActive($data['active'])
            ->setDeleted($data['deleted']);

        return $accountEntity;
    }

    public function testThatDefaultsAreCorrectlySet() {
        $accountEntity = new UserAccount();

        $this->assertFalse($accountEntity->getActive());
        $this->assertFalse($accountEntity->getDeleted());

        $timeToTest = new DateTime('now');
        $timeToTest->modify('-2 minutes');

        $this->assertGreaterThan($timeToTest, $accountEntity->getCreatedAt());
        $this->assertGreaterThan($timeToTest, $accountEntity->getUpdatedAt());

        $this->assertEquals(20, strlen($accountEntity->getSeed()));
    }

    public function testAllGettersAndSettersWorkCorrectly() {
        $accountEntity = $this->createNewEntityFromArray($this->seedData);

        $this->assertEquals($this->seedData['username'], $accountEntity->getUsername());
        $this->assertEquals($this->seedData['email'], $accountEntity->getEmail());
        $this->assertEquals($this->seedData['fullname'], $accountEntity->getFullName());
        $this->assertEquals($this->seedData['active'], $accountEntity->getActive());
        $this->assertEquals($this->seedData['deleted'], $accountEntity->getDeleted());
        $this->assertNotNull($accountEntity->getPassword());
    }

    public function testEncryptionOfPasswordUsingSeedSystem() {
        $password = GeneralHelperService::generateRandomString(30);
        $accountEntity = new UserAccount();
        $accountEntity->setPassword($password);

        $this->assertNotNull($accountEntity->getSeed());
        $seed = $accountEntity->getSeed();

        $this->assertNotNull($accountEntity->getPassword());
        $this->assertEquals(128, strlen($accountEntity->getPassword()));
        $this->assertEquals(hash('sha512', $seed . $password), $accountEntity->getPassword());
    }
}