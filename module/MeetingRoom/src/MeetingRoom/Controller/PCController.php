<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.08.14
 * Time: 11:07
 */

namespace MeetingRoom;

use MeetingRoom\Model\MeetingRoomList;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MeetingRoom\Entity\MeetingRoom as MeetingRoomEntity;
use MeetingRoom\Entity\PC;
class PCController extends AbstractActionController
{
    public function indexAction()
    {
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $listMeetingRoom = $entityManager->getRepository('MeetingRoom\Entity\MeetingRoom')->findAll();

        return array('listMeetingRoom' => $listMeetingRoom);
    }

    public function addAction()
    {
        $data = array(
            'title' => 'Form add meeting room!!!'
        );

        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $pc = new PC();
        $pc->setTitle('PC-235');

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