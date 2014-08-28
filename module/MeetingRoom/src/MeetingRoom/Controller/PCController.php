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
use Doctrine\ORM\EntityManager;


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

        /**
         * @var \MeetingRoom\Mapper\PcMapper $pcMapper
         */
        $pcMapper= $this->getServiceLocator()->get('MeetingRoom\Mapper\PC');

        return array('listMeetingRoom' => $pcMapper->getList());

    }

    public function editAction(){


        $id = $this->params()->fromRoute('id');
        /**
         * @var \MeetingRoom\Mapper\PcMapper $pcMapper
         */
        $pcMapper = $this->getServiceLocator()->get('MeetingRoom\Mapper\PC');

        if($id && $pc = $pcMapper->getItemById($id)){

            $form = $this->getServiceLocator()->get('Form\PcForm');

            $form->bind($pc);

            if ($this->request->isPost()) {
                $form->setData($this->request->getPost());
                if ($form->isValid()) {
                    $this->flushEntity($pc);
                    return $this->redirect()->toRoute('room',array('controller'=>'pc','action'=>'list'));
                }

        }

            $data = array(
                'title'=> 'Создание нового компа',
                'form'=>$form
                );


        }   else{
            $data = array('error' => 'Input id to URL');
        }

        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/form/add-pc');
        return $view;

    }

    public function addAction(){

        $form = $this->getServiceLocator()->get('Form\PcForm');
        $pc = $this->getServiceLocator()->get('Entity\PC');

        $form->bind($pc);

        if($this->request->isPost()){

            $form->setData($this->request->getPost());
            var_dump($this->request->getPost());

            if($form->isValid()){

                $this->flushEntity($pc);
                return $this->redirect()->toRoute('room',array('controller'=>'pc','action'=>'list'));

            } else{

                echo '\n'.'Ужасная ошибка!';
            }

        }

        $data = array(
            'title'=> 'Создание нового компа',
            'form' => $form
        );

        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/form/add-pc');
        return $view;

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

} 