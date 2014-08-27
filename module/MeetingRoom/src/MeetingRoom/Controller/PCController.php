<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.08.14
 * Time: 10:57
 */

namespace MeetingRoom\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MeetingRoom\Entity\MeetingRoom as MeetingRoomEntity;
use MeetingRoom\Entity\PC;
use MeetingRoom\Form\PcForm as PcForm;
use MeetingRoom\Form\PCFilter;

class PCController extends AbstractActionController {

    public function indexAction()
    {
        $data = array(
            'title' => 'HELLO, I AM CONTROLLER PC CONTROLLER INDEXACTION!!!'
        );

        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/form/edit-meeting-room');
        return $view;
    }


    public function listAction(){

        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $listMeetingRoom = $entityManager->getRepository('MeetingRoom\Entity\PC')->findAll();

        return array('listMeetingRoom' => $listMeetingRoom);

    }

    public function editAction(){

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

    public function addAction(){

        // С помощью плагина контроллера getRequest
        $request = $this->getRequest();

        $form = new PcForm;
        $formInputFilter = new PcFilter();
        $form->SetInputFilter($formInputFilter->getInputFilter());

        if($request->isPost()){
            // Устанавливаем данные из Post
            $form->setData($request->getPost());

            if($form->isValid()){
                echo 'Validate data!';
            } else{

                echo 'errro!';
            }

        }

        $data = array(
            'title'=> 'Form create PC',
            'form' => $form
        );

        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/form/add-meeting-room');
        return $view;

    }

} 