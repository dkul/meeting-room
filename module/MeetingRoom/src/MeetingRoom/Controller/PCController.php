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
use MeetingRoom\Form\PcForm;
use MeetingRoom\Form\PcFilter;
use Application\Grid\AbstractGrid;


class PCController extends AbstractActionController {

    public function indexAction(){
        $data = array('title' => 'Hello,This is PCPC');
        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/form/edit-meeting-room');
        return $view;
    }

    public function listAction(){


        /**
         * @var \MeetingRoom\Mapper\PcMapper $pcMapper
         */
        $pcMapper=$this->getServiceLocator()->get('MeetingRoom\Mapper\PC');
        /*$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $listMeetingRoom = $entityManager->getRepository('MeetingRoom\Entity\PC')->findAll();*/
        //return array('listMeetingRoom' => $listMeetingRoom);
        return array('listMeetingRoom' =>$pcMapper->getList());


    }

    public function editAction()
    {

        $id = $this->params()->fromRoute('id');

        if(!empty($id)){
            $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $result = $entityManager->getRepository('MeetingRoom\Entity\PC')->find($id);
           /* $data = array('result' => $result);*/
        }
        $form = new PcForm();
        $form->bind($result);

        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());
            if ($form->isValid())
            {
                $this->flushEntity($result);
                return $this->redirect()->toRoute('pcpc',array('controller'=>'PCController','action'=>'list'));
            }
        }
        $data=array(
            'title'=>'This is edit menu:',
            'form'=>$form,
        );
        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/form/add-pc');
        return $view;

        //параметр из route - id
       /* else{
            $data = array('error' => 'Input id to URL');
        }

        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/form/edit-pc');
        return $view;*/
    }


    public function getEntity($entity){
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        return $entityManager->getRepository('MeetingRoom\Entity'.$entity);
    }
    public function flushEntity($entity){
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $entityManager->persist($entity);
        $entityManager->flush();
    }
    public function addAction()
    {

        $form = new PcForm();
        $pc = new PC();
        $form->bind($pc);

        if ($this->request->isPost()) {
        $form->setData($this->request->getPost());
        if ($form->isValid())
        {
            $this->flushEntity($pc);
            return $this->redirect()->toRoute('pcpc',array('controller'=>'PCController','action'=>'list'));
        }
       }
       $data=array(
            'title'=>'This is the Form',
            'form'=>$form,
        );
        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/form/add-pc');
        return $view;
    }


}
