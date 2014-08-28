<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 14:56
 */

namespace MeetingRoom\Model;

use Application\Grid\AbstractGrid;

class MeetingRoomGrid extends AbstractGrid{
    public function getList(){
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $this->entityManager();
        $queryBuilder = $em->createQueryBuilder();
        $queryBuilder->select('m.title as m_title, m.id, pc.id pc.title as pc_title')
            ->from('MeetingRoom\Entity\MeetingRoom', 'm')
            ->innerJoin('MeetingRoom\Entity\PC', 'pc', 'WITH', 'm.pc = pc.id')
            ->orderBy('m.title', 'ASC');
        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }

} 