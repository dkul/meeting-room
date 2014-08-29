<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 16:17
 */

namespace MeetingRoom\Model;

use Application\Grid\AbstractGrid;

class PcGrid extends AbstractGrid
{
    public function getList()
    {
        $em= $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder();
        $queryBuilder->select('pc.title as pc_title, pc.isCamera as isCamera, pc.isInternet as isInternet')
            ->from('MeetingRoom\Entity\PC', 'pc');
        $query = $queryBuilder->getQuery();
        // echo $query->getSQL(); просмотр сгенерированного sql
        return $query->getResult();
    }

} 