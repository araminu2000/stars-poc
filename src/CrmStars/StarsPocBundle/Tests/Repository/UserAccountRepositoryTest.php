<?php

namespace CrmStars\StarsPocBundle\Tests\Repository;


use CrmStars\StarsPocBundle\Entity\UserAccount;
use CrmStars\StarsPocBundle\Repository\UserAccountRepository;
use CrmStars\StarsPocBundle\Service\GeneralHelperService;

class UserAccountRepositoryTest extends BaseRepository {

    protected $seedData;

    /**
     * @var UserAccountRepository
     */
    protected $repo;

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

        $this->repo = $this->em->getRepository('CrmStarsStarsPocBundle:UserAccount');
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

    public function testPersistSimpleEntity() {
        $accountEntity = $this->createNewEntityFromArray($this->seedData);
        $this->repo->createOne($accountEntity);

        $foundEntity = $this->repo->find($accountEntity->getId());

        $this->assertEquals($accountEntity, $foundEntity);
    }
}