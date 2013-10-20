<?php

namespace CrmStars\StarsPocBundle\Repository;


use Doctrine\ORM\EntityRepository;
use CrmStars\StarsPocBundle\Entity\UserAccount;

/**
 * Class UserAccountRepository handles DB mapping procedures for the UserAccount entity.
 * @package CrmStars\StarsPocBundle\Repository
 */
class UserAccountRepository extends EntityRepository {

    public function createOne($entity) {
        $this->_em->persist($entity);
        $this->_em->flush();
    }
}