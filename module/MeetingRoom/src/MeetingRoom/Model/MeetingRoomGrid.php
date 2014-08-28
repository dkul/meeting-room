<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 14:54
 */

namespace MeetingRoom\Model;

use Application\Grid\AbstractGrid;


class MeetingRoomGrid extends AbstractGrid {



    public function getList()
    {
        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder();
        $queryBuilder->select('m.title as m_title, m.id, pc.title as pc_title') // выбираем все из entity m and entity pc
            ->from('MeetingRoom\Entity\MeetingRoom','m')
            ->innerJoin('MeetingRoom\Entity\PC','pc','WITH','m.pc = pc.id')
            ->orderBy('m.title','ASC');
        $query = $queryBuilder->getQuery();

        // echo $query->getSQL(); // просмотр сгенерированного sql
        return $query->getResult();

    }


} 