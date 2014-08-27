<?php

namespace MeetingRoom\Controller;

use MeetingRoom\Form\PcFilter;
use MeetingRoom\Model\MeetingRoomList;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MeetingRoom\Entity\MeetingRoom as MeetingRoomEntity;
use MeetingRoom\Entity\PC;
use MeetingRoom\Form\PcForm;


class PcController extends AbstractActionController
{
    public function indexAction()
        {
            echo "kkkkkkkkkkkkkkkk";
           /* $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $listMeetingRoom = $entityManager->getRepository('MeetingRoom\Entity\PC')->findAll();

            return array('listMeetingRoom' => $listMeetingRoom);*/
        }

    public function addAction()
        {
            $request=$this->getRequest();


            $form = new PcForm();
            $formInputFilter = new PcFilter();
            $form->setInputFilter($formInputFilter->getInputFilter());

            $form ->setData($request->getPost());

            if($request->isPost()){
                $form->setData($request->getPost());

            if($form->isValid()){
                echo "Validate data!";

            }else{
                echo "error validate!";
            }}
            $data = array(
                'title'=>'Form create PC',
                'form' => $form
            );

            $view = new ViewModel($data);
            $view->setTemplate('meeting-room/form/add-meeting-room');
            return $view;
        }

    public function editAction()
        {
            echo "edit";
        }
    public function deleteAction()
        {
            echo "delete";
        }


}