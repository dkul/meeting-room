<?php
namespace RgkhCommon\Base\Mapper;

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