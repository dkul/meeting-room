<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.08.14
 * Time: 14:44
 */

namespace MeetingRoom\Model;

use Application\Grid\AbstractGrid;


class MeetingRoomGrid extends AbstractGrid {
    /**
     * @var \Doctrine\ORM\EntityManager $em
     */
    public function getList(){
        $em =$this->getEntityManager();
        $queryBuilder=$em->createQueryBuilder();
        $queryBuilder->select('m.title as m_title, m.id, pc.title as pc_title')
                     ->from('MeetingRoom\Entity\MeetingRoom', 'm')
                     ->innerJoin('MeetingRoom\Entity\PC','pc','WITH','m.pc=pc.id')
                      ->orderBy('m.title' ,'ASC');
        $query=$queryBuilder->getQuery();
       // echo $query;
        return $query->getResult();
    }

} 