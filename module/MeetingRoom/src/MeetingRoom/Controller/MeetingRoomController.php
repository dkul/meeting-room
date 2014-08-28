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

/*class MeetingRoomController extends AbstractActionController
{
    public function indexAction()
    {

        $plugin=$this->myFirstPlugin();
//        var_dump($plugin->getList());

        $model = $this->getServiceLocator()->get('Model\MeetingRoomList');
        return $model->get();



    }
    public function addAction()
    {

        $data = array(
            'title' => 'Form add meeting room!!!'

        );

        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $pc = new PC();
        $pc->setTitle('PC-234');
        $pc->setInInternet(true);
        $pc->setIsCamera(false);

        $entityManager->persist($pc);


        $meetingRoom =new MeetingRoomEntity();

        $meetingRoom->setTitle('Альфа');
        $meetingRoom->setPlace('3 этаж, 101');
        $meetingRoom->setCapacity(5);
        $meetingRoom->setPc($pc);

        $entityManager->persist($meetingRoom);// с этого момента entityManager отслеживает все изменения в объекте

        $entityManager->flush();

        $data['meeting_room_id'] = $meetingRoom->getId(); // передадим айдишник, кот создала доктрина во вьюху
        $data['pc_title'] = $pc->getTitle();

        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/form/add-meeting-room');
        return $view;

    }

    public function listAction()
    {

        return array(
            'title'=>"Hello, Wold",
            'listItems' => array(
                'id' => 1,
                'title' => 2,
                'description' =>array(1,2,3)
            )

        );

    }

    public function editAction()
    {
        $id = $this->params()->fromRoute('params');
        if(!empty($id)){

            $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $result = $entityManager->getRepository('MeetingRoom\Entity\MeetingRoom')->find($id);

            $data = array('meetingRoom' => $result);

        } else {

            $data = array('error' => 'Input id to URL');
        }

        //   $layout = $this->layout();
        //   $layout->setTemplate('meeting-room/layout/meeting-room-layout');

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

    private function test() {

    }

}*/


class MeetingController extends AbstractActionController
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