<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace MeetingRoom\Controller;

use MeetingRoom\Form\PcFieldSet;
use MeetingRoom\Model\MeetingRoomList;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MeetingRoom\Entity\MeetingRoom as MeetingRoomEntity;
use MeetingRoom\Entity\PC;
use MeetingRoom\Form\PcForm;
use MeetingRoom\Form\PcFilter;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        /*$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $listMeetingRoom = $entityManager->getRepository('MeetingRoom\Entity\MeetingRoom')->findAll();*/

        $pcGrid=$this->getServiceLocator()->get('MeetingRoom\Grid\MeetingRoom');
        $listMeetingRoom=$pcGrid->getList();

        return array('listMeetingRoom' => $listMeetingRoom);
    }

    public function addAction()
    {

        $form = new PcForm();
        $pc = new PC();
        $form->bind($pc);

        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
               $objectManager=$this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
               $objectManager->persist($form->getData());
               $objectManager->flush();
            }
        }

        $data=array(
            'title'=>"Form",
            'form'=>$form,
        );

        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/form/add-meeting-room');
        return $view;

       /* $request=$this->getRequest();


        $form = new PcForm();
        $formInputFilter=new PcFilter();
        $form->setInputFilter($formInputFilter->getInputFilter());

        if ($request->isPost()){
            $form->setData($request->getPost());
            if($form->isValid()){
                echo 'Velidatedata!';
            }else {
                echo 'Error validate!';
            }
        }
        $data=array(
            'title'=>'Create PC',
            'form'=>$form
        );
        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/form/add-meeting-room');
        return $view;*/




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
