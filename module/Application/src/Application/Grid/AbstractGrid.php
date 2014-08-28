<?php

namespace Application\Grid;

use Doctrine\ORM\EntityManager;


use Application\Mapper\EntityManagerAwareInterface;

abstract class AbstractGrid implements EntityManagerAwareInterface
{
    protected $paginator;

    protected $entityManager;

    abstract public function getList();

    public function setPaginator($paginator)
    {
        $this->paginator=$paginator;
    }

    public function getPaginator()
    {
      return  $this->$paginator;
    }


    public function setEntityManager (EntityManager $em)
    {

        $this->entitymanager = $em;
    }

    public function getEntityManager()
    {

      return  $this->entitymanager;
    }

}