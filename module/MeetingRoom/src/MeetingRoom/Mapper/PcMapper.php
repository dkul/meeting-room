<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 14:26
 */

namespace MeetingRoom\Mapper;

use Application\Mapper\AbstructMapper;
use Doctrine\ORM\EntityManager;
class PcMapper extends AbstructMapper
{
    public function __construct(EntityManager $em){
        parent::__construct($em, 'MeetingRoom\Entity\PC');
    }

    public function getList(){
        return $this->getEntityManager()->getRepository($this->getEntityClass());
    }
} 