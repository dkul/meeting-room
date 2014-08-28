<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 14:51
 */

namespace Application\Grid;


use Doctrine\ORM\EntityManager;
use Application\Mapper\EntityManagerAwareInterface;

abstract class AbstractGrid implements EntityManagerAwareInterface
{
    protected $paginator;

    abstract public function getList();

    public function setPaginator($paginator){
        $this->paginator = $paginator;
    }

    public function getPaginator(){
        return $this->paginator;

    }

    public function setEntityManager(EntityManager $em){
        $this->entityManager = $em;
    }

    public function getEntityManager(){
        return $this->entityManager;
    }

}
