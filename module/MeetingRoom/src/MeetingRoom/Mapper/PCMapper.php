<?php

namespace MeetingRoom\Mapper;

use Application\Mapper\AbstractMapper;
use Doctrine\ORM\EntityManager;

class PCMapper extends AbstractMapper
{
    public function __construct(EntityManager $em)
    {
        parent::__construct($em,'\MeetingRoom\Entity\PC');
    }

    public function getList()
    {
        return $this->getEntityManager()->getRepository($this->getEntityManager());
    }
} 