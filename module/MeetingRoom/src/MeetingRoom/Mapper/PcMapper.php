<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kuleshov
 * Date: 29.08.14
 * Time: 7:02
 * To change this template use File | Settings | File Templates.
 */

namespace MeetingRoom\Mapper;

use Base\Mapper\AbstractMapper;
use Doctrine\ORM\EntityManager;

class PcMapper extends AbstractMapper
{
    const EntityClass = 'MeetingRoom\Entity\PC';

    public function __construct(EntityManager $em){
        parent::__construct($em, self::EntityClass);
    }

    public function getList()
    {
        return $this->getEntityManager()->getRepository(self::EntityClass)->findAll();
    }
}