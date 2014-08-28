<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 14:26
 */

namespace MeetingRoom\Mapper;

use Application\Mapper\AbstractMapper;
use Doctrine\ORM\EntityManager;
use Doctrine\Tests\Common\Annotations\Ticket\Doctrine\ORM\Entity;

class PcMapper extends AbstractMapper{
    public function __construct(EntityManager $em) {
        parent::__construct($em, 'MeetingRoom\Entity\PC');
    }

    public function getList() {
        return $this->getEntityManager()->getRepository($this->getEntityClass());
    }
} 