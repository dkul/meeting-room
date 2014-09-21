<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 10.09.14
 * Time: 21:19
 */

namespace MeetingRoom\Mapper;

use Base\Mapper\AbstractMapper;
use Doctrine\ORM\EntityManager;


class UserMapper extends AbstractMapper {

    const EntityClass = 'MeetingRoom\Entity\User';

    public function __construct(EntityManager $em){
        parent::__construct($em, self::EntityClass);
    }

    public function getList()
    {
        return $this->getEntityManager()->getRepository(self::EntityClass)->findAll();
    }


} 