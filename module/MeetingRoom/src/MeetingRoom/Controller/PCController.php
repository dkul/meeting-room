<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.08.14
 * Time: 10:59
 */

namespace MeetingRoom\Controller;

use MeetingRoom\Model\MeetingRoomList;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MeetingRoom\Entity\MeetingRoom as MeetingRoomEntity;
use MeetingRoom\Entity\PC;

class PCController extends AbstractActionController {

    public function indexAction(){
        $data = array('title' => 'Hello,This is PCPC');
        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/form/edit-meeting-room');
        return $view;
    }

    public function listAction(){
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $listMeetingRoom = $entityManager->getRepository('MeetingRoom\Entity\PC')->findAll();
        return array('listMeetingRoom' => $listMeetingRoom);


    }

    public function editAction()
    {
        //параметр из route - id
        $id = $this->params()->fromRoute('id');
        if(!empty($id)){
            $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $result = $entityManager->getRepository('MeetingRoom\Entity\PC')->find($id);

            $data = array('result' => $result);
        }else{
            $data = array('error' => 'Input id to URL');
        }

        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/form/edit-pc');
        return $view;
    }
}
