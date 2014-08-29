<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace MeetingRoom\Controller;

use MeetingRoom\Model\MeetingRoomList;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MeetingRoom\Entity\MeetingRoom as MeetingRoomEntity;
use MeetingRoom\Entity\PC;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
      /*  $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $listMeetingRoom = $entityManager->getRepository('MeetingRoom\Entity\MeetingRoom')->findAll();

        return array('listMeetingRoom' => $listMeetingRoom);
      */
        $pcGrid= $this->getServiceLocator()->get('MeetingRoom\Grid\MeetingRoom');
        $listMeetingRoom = $pcGrid->getList();
        return array ('listMeetingRoom' => $listMeetingRoom);
    }

    public function addAction()
    {
        $data = array(
            'title' => 'Form add meeting room!!!'
        );

        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $pc = new PC();
        $pc->setTitle('PC-234');

        $entityManager->persist($pc);

        $meetingRoom = new MeetingRoomEntity();
        $meetingRoom->setTitle('Альфа3');
        $meetingRoom->setPlace('3 этаж, 103');
        $meetingRoom->setCapacity(3);
        $meetingRoom->setPc($pc);

        $entityManager->persist($meetingRoom);
        $entityManager->flush();

        $data['meeting_room_id'] = $meetingRoom->getId();

        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/form/add-meeting-room');
        return $view;
    }

    public function editAction()
    {
        //параметр из route - id
        $id = $this->params()->fromRoute('id');
        if(!empty($id)){
            $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $result = $entityManager->getRepository('MeetingRoom\Entity\MeetingRoom')->find($id);

            $data = array('result' => $result);
        }else{
            $data = array('error' => 'Input id to URL');
        }

        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/form/edit-meeting-room');
        return $view;
    }

    public function deleteAction()
    {
        $view = new ViewModel(
            array(
                'title' => 'Delete action'
            )
        );
        $view->setTemplate('meeting-room/form/edit-meeting-room');
        $view->setTerminal(true);
        return $view;
    }

    public function listAction(){

    }
}
