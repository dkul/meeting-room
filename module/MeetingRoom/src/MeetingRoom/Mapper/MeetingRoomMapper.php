<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 14:37
 */

namespace MeetingRoom\Mapper;

use Base\Mapper\AbstractMapper;
use Doctrine\ORM\EntityManager;

class MeetingRoomMapper extends AbstractMapper
{
    const EntityClass = 'MeetingRoom\Entity\PC';

    public function __construct(EntityManager $em){
        parent::__construct($em, self::EntityClass);
    }

    public function getList(){
        return $this->getEntityManager()->getRepository($this->getEntityClass())->findAll();
    }
} 