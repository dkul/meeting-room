<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.08.14
 * Time: 10:46
 */

namespace MeetingRoom\Controller;

use Doctrine\ORM\EntityManager;
use MeetingRoom\Form\PcForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MeetingRoom\Entity\PC ;


class PcController extends AbstractActionController{
    public function listAction(){

         $pcMapper= $this->getServiceLocator()->get('MeetingRoom\Mapper\PC');
         $listPc=$this->getEntity('\PC')->findAll();

        return array('listPc' => $pcMapper->getList());
    }
    public function editAction(){
        //$form=new PcForm;
        $id = $this->params()->fromRoute('id');


        $pcMapper=$this->serviceLocator()->get('MeetingRoom\Mapper\PC');



        if($pc=$pcMapper->getItemById($id)){
            $form = $this->getServiceLocator()->get('Form\PcForm');
            $form->bind($pc);
            if ($this->request->isPost()) {
                $form->setData($this->request->getPost());
                if ($form->isValid()) {
                    $this->flushEntity($pc); //моя функция. флушит
                    return $this->redirect()->toRoute('rooms',array('controller'=>'pc','action'=>'list'));
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
    public  function addAction(){
        $form = $this->getServiceLocator()->get('Form\PcForm');
        $pc = $this->getServiceLocator()->get('Entity\PC');
        $form->bind($pc);

        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());
            if ($form->isValid()) {
                $this->flushEntity($pc);
                return $this->redirect()->toRoute('rooms',array('controller'=>'pc','action'=>'list'));
            }
        }

        return array(
            'form' => $form,
            'title'=>'Добавление нового компьютера'
        );
    }

    public  function deleteAction(){
        return new ViewModel();
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