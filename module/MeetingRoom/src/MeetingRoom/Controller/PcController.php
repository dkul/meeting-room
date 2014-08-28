<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace MeetingRoom\Controller;


use MeetingRoom\Form\PcForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MeetingRoom\Entity\PC;



class PcController extends AbstractActionController
{
    public function indexAction()
    {
       /* $pcGrid = $this->getServiceLocator()->get('MeetingRoom\Grid\MeetingRoom');
        $listMeetingRoom = $pcGrid->getList();
        return array('listMeetingRoom' => $listMeetingRoom);*/

        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $listPc = $entityManager->getRepository('MeetingRoom\Entity\PC')->findAll();

        return array('listPc' => $listPc);
        echo "Hello, I'm Index!";
    }

    public function addAction()
    {
       /* $data = array(
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
        return $view;*/
        /*$request = $this -> getRequest();

        $form = new PcForm();
        $formInputFilter = new PcFilter();
        $form->setInputFilter($formInputFilter->getInputfilter());



        $form->setData($request->getPost());

        if ($form->isValid()){
            var_dump($form->getData());
            echo 'Validate data!';
        } else {
            echo 'Error validate!';
        }

        $data = array(
            'title' => 'Form create PC',
        'form' => $form
        );

        return $data;*/

        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $form = new PcForm();
        $pc = new PC();
        $form->bind($pc);

        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                var_dump($pc);
                $entityManager->persist($pc);
                $entityManager->flush($pc);
            }
        }

        return array(
            'form' => $form
        );
    }


    public function editAction()
    {
       /* //параметр из route - id
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
        return $view;*/
        echo "Hello, i'm edit!";
    }

    public function deleteAction()
    {
        /*$view = new ViewModel(
            array(
                'title' => 'Delete action'
            )
        );
        $view->setTemplate('meeting-room/form/edit-meeting-room');
        $view->setTerminal(true);
        return $view;*/
        echo "Hello, I'm delete!";
    }

    public function listAction(){

    }
}