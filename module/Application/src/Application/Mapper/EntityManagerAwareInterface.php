<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 14:22
 */

namespace Application\Mapper;

use Doctrine\ORM\EntityManager;


interface EntityManagerAwareInterface
{
    /**
     * @return EntityManager
     */
    public function getEntityManager();

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @return void
     */
    public function setEntityManager(EntityManager $entityManager);
} 