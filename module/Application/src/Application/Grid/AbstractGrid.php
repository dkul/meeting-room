<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 14:51
 */

namespace Application\Grid;

use Application\Mapper\EntityManagerAwareInterface;
use Doctrine\ORM\EntityManager;


abstract class AbstractGrid implements EntityManagerAwareInterface
{
    protected $paginator;

    protected $entityManger;

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