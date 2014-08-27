<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.08.14
 * Time: 11:34
 */

namespace MeetingRoom\Controller;

use MeetingRoom\Model\MeetingRoomList;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MeetingRoom\Entity\MeetingRoom as MeetingRoomEntity;
use MeetingRoom\Entity\PC;
use MeetingRoom\Form\PcForm;


class PCController extends AbstractActionController  {
   /* public function indexAction()
    {
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $listMeetingRoom = $entityManager->getRepository('MeetingRoom\Entity\MeetingRoom')->findAll();

        return array('listMeetingRoom' => $listMeetingRoom);
    }*/

    public function indexAction()
    {
        $form = new PcForm();
        $data = array(
            'form' => $form
        );
        return $data;

    }

}