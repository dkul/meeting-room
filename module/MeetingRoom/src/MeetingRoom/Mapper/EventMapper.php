<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 19.09.14
 * Time: 17:13
 */

namespace MeetingRoom\Mapper;

use Base\Mapper\AbstractMapper;
use Doctrine\ORM\EntityManager;

class EventMapper extends AbstractMapper
{
    const EntityClass = 'MeetingRoom\Entity\Event';

    public function __construct(EntityManager $em){
        parent::__construct($em, self::EntityClass);
    }

    public function getList()
    {
        return $this->getEntityManager()->getRepository(self::EntityClass)->findAll();
    }

} 