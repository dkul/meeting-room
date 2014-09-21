<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 10.09.14
 * Time: 21:31
 */

namespace MeetingRoom\Controller;

use MeetingRoom\Model\MeetingRoomList;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController{

    public function indexAction()
    {
        /*$this->redirect()->toRoute('pc', array('action' => 'list'));*/
       /*
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $listMeetingRoom = $entityManager->getRepository('MeetingRoom\Entity\User')->findAll();

        return array('listMeetingRoom' => $listMeetingRoom);*/

       /* return new ViewModel();*/

        $userMapper = $this->getServiceLocator()->get('MeetingRoom\Mapper\User');
        return array('listUser' => $userMapper->getList());
    }

    public function addAction(){


        $userMapper = $this->getServiceLocator()->get('MeetingRoom\Mapper\User');
        $userForm   = $this->getServiceLocator()->get('MeetingRoom\Form\User');

        if($this->request->isPost()){

           $userForm->setData($this->request->getPost());

            if($userForm->isValid()){

                $userMapper->save($userForm->getData());
                $this->redirect()->toRoute('user', array('action' => 'index'));
            }

        }

        $view = new ViewModel(array(
            'form' => $userForm
        ));
        $view->setTemplate('meeting-room/user/user-form');
        return $view;
    }

    public function editAction()
    {

        $userFormE   = $this->getServiceLocator()->get('MeetingRoom\Form\User');
        $userMapperE = $this->getServiceLocator()->get('MeetingRoom\Mapper\User');


        $id = $this->params()->fromRoute('id');

        if(!empty($id)){
            $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $result = $entityManager->getRepository('MeetingRoom\Entity\User')->find($id);
            $data = array('result' => $result);
        }

        $userFormE->bind($result);

        if($this->request->isPost()){
            $userFormE->setData($this->request->getPost());
            if($userFormE->isValid()){
                $userMapperE->save($userFormE->getData());
                $this->redirect()->toRoute('user', array('action' => 'index'));
            }

        }

        $view = new ViewModel(array(
            'form' => $userFormE
        ));
        $view->setTemplate('meeting-room/user/user-form');
        return $view;

    }
}