<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.08.14
 * Time: 14:44
 */

namespace MeetingRoom\Model;

use Application\Grid\AbstractGrid;
use Application\Mapper\EntityManagerAwareInterface;

class MeetingRoomGrid extends AbstractGrid
{
    public function getList()
    {
     $em = $this->getEntityManager();
     $queryBuilder = $em->createQueryBuilder();
     $queryBuilder->select('m, pc')
         ->from('MeetingRoom\Entity\MeetingRoom', 'm')
         ->innerJoin('MeetingRoom\Entity\PC', 'pc', 'WITH', 'm.pc = pc.id')
         ->orderBy('m.title', 'ASC');
     $query = $queryBuilder->getQuery();
     return $query->getResult();
    }

} 