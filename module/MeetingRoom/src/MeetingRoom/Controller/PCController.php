<?php

namespace MeetingRoom\Controller;

use MeetingRoom\Form\PCFilter;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use MeetingRoom\Model\MeetingRoomList;
use MeetingRoom\Entity\PC as PCEntity;
use MeetingRoom\Entity\PC;
use MeetingRoom\Form\PCForm;


class PCController extends AbstractActionController{

    public function indexAction()
    {
        //$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        //$listMeetingRoom = $entityManager->getRepository('MeetingRoom\Entity\MeetingRoom')->findAll();

        $data = array(
            'title' => "PCController Index Title",
        );

        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/pc/pcIndex');
        return $view;
    }

    public function addAction()
    {
        $request = $this->getRequest();

        $form = new PCForm();
        $formInputFilter = new PCFilter();
        $form->setInputFilter($formInputFilter->getInputFilter());

        $form->setData($request->getPost());

        if ($form->isValid()){
            echo 'Validate data!';
        }
        else
            echo 'Invalid data!';

        $data = array(
            'form' => $form,
            'title' => "Add Title",
        );

        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/pc/pcAdd');
        return $view;

    }

    public function editAction()
    {

    }

    public function listAction()
    {
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $listPC = $entityManager->getRepository('MeetingRoom\Entity\PC')->findAll();

        $view = new ViewModel($data = array('listPC' => $listPC));
        $view->setTemplate('meeting-room/pc/pcList');
        return $view;

    }

    public function deleteAction()
    {

    }


}