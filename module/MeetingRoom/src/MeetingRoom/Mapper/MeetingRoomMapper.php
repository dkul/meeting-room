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
    const EntityClass = 'MeetingRoom\Entity\MeetingRoom';

    public function __construct(EntityManager $em){
        parent::__construct($em, self::EntityClass);
    }

    public function getList(){
        return $this->getEntityManager()->getRepository(self::EntityClass)->findAll();
    }
//????????????//////////////////////////////////////////?????????????????///////////////
    public function getListNotUsed(){
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

        $queryBuilder->select('meeting_room')
            ->from('MeetingRoom\Entity\MeetingRoom', 'meeting_room')
            ->leftJoin('MeetingRoom\Entity\Table', 't', 'WITH', 'meeting_room.id = t.meeting_room')
            ->where('t.meeting_room IS NULL');
        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }
//??????????????????????????///////////////////////////////////////////////////////////////

} 