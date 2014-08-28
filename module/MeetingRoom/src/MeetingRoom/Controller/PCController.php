<?php

namespace MeetingRoom\Controller;

use MeetingRoom\Form\listPcForm;
use MeetingRoom\Form\PCFieldset;
use MeetingRoom\Model\PCList;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MeetingRoom\Entity\MeetingRoom as MeetingRoomEntity;
use MeetingRoom\Entity\PC;
use MeetingRoom\Form\PcFilter;
use MeetingRoom\Form\PcForm;

class PCController extends AbstractActionController
{
    public function indexAction()
    {
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $listPC = $entityManager->getRepository('MeetingRoom\Entity\PC')->findAll();

        return array('listPC' => $listPC);
    }

    public function addAction()
    {
        $form = $this->getServiceLocator()->get('Form\PcForm');
        $pc = $this->getServiceLocator()->get('Entity\PC');
        $form->bind($pc);

        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());
            if ($form->isValid()) {
                $this->flushEntity($pc);
                return $this->redirect()->toRoute('pcs',array('controller'=>'pc','action'=>'list'));
            }
        }

        return array(
            'form' => $form,
            'title'=>'Add'
        );
    }

    public function editAction()
    {
        $id = $this->params()->fromRoute('id');


        if($pc=$this->getEntity('\PC')->find($id)){
            $form = $this->getServiceLocator()->get('Form\listPCForm');
            $form->bind($pc);
            if ($this->request->isPost()) {
                $form->setData($this->request->getPost());
                if ($form->isValid()) {
                    $this->flushEntity($pc);
                    return $this->redirect()->toRoute('pcs');
                }
            }

            return array(
                'form'=>$form,
                'pc'=>$pc


            );
        }
        return array(
            'error'=>'Нет компьютера с указанным id.'
        );
    }



//        //параметр из route - id
//        $id = $this->params()->fromRoute('id');
//        if(!empty($id)){
//            $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
//            $result = $entityManager->getRepository('MeetingRoom\Entity\PC')->find($id);
//
//            $data = array('result' => $result);
//        }else{
//            $data = array('error' => 'Input id to URL');
//        }
//
//        $view = new ViewModel($data);
//        $view->setTemplate('meeting-room/form/edit-PC');
//        return $view;


    public function deleteAction()
    {
    }

    public function listAction()
    {
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $listPC = $entityManager->getRepository('MeetingRoom\Entity\PC')->findAll();

        return array('listPC' => $listPC);
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

