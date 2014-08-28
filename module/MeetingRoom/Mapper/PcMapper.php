<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 14:25
 */

namespace MeetingRoom\Mapper;

use Application\Mapper\AbstractMapper;
use Doctrine\ORM\EntityManager;

class PcMapper extends AbstractMapper{
 public function __construct(EntityManager $em)
 {
     parent::__construct($em, 'MeetingRoom\Entity\PC');
 }
    public function getList(){
        $this->getEntityManager()->getRepository($this->getEntityClass()->findAll());
    }
} 