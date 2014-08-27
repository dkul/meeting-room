<?php

namespace MeetingRoom\Controller;


use MeetingRoom\Form\PcFilter;
use MeetingRoom\Model\MeetingRoomList;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MeetingRoom\Form\PcForm;
//use MeetingRoom\Form\PcFilter;


class PCController extends AbstractActionController
{
    public function indexAction(){
        $data= array('title'=>'PC Title');
        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/form/edit-meeting-room');
        return $view;
    }

   public function listAction(){

       $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
       $listPC = $entityManager->getRepository('MeetingRoom\Entity\PC')->findAll();

       return array('listPC' => $listPC);

   }

    public function addAction(){

        $request = $this->getRequest();

        $form = new PcForm();
        $formInputFilter = new PcFilter();
        $form->setInputFilter($formInputFilter->getInputFilter());

        $form->setData($request->getPost());

        if($form->isValid()){
            echo 'Validate data';
        }else{
            echo 'Invalid data';
        }

        $data = array(
            'title' => 'Form create PC',
            'form' => $form
        );
        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/pc/add-pc');
        return $view;

    }
}