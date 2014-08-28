<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.08.14
 * Time: 10:57
 */

/*
namespace MeetingRoom\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MeetingRoom\Entity\MeetingRoom as MeetingRoomEntity;
use MeetingRoom\Entity\PC;
use MeetingRoom\Form\PcForm as PcForm;*/


/*class PCController extends AbstractActionController{
    public function listAction(){

        $listPc=$this->getEntity('\PC')->findAll();
        return array('listPc' => $listPc);
    }
    public function editAction(){

        $id = $this->params()->fromRoute('id');

        if(!empty($id)){
            $pc=$this->getEntity('\PC')->find($id);
            $data = array('pc' => $pc);
        }
        else{
            $data = array('error' => 'Input id to URL');
        }

        $view = new ViewModel($data);
        return $view;

    }

    public function addAction(){

        $form = new PcForm;

        $data = array(
            'title'=> 'Form create PC',
            'form' => $form
        );

        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/form/add-meeting-room');
        return $view;

    }

    public  function deleteAction(){
        return new ViewModel();
    }

    public function getEntity($entity){
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        return $entityManager->getRepository('MeetingRoom\Entity'.$entity);
    }

}*/


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

class PCController extends AbstractActionController{
    public function listAction(){

        /**
         * @var \MeetingRoom\Mapper\PcMapper $pcMapper
         */
        $pcMapper= $this->getServiceLocator()->get('MeetingRoom\Mapper\PC');
        return array('listMeetingRoom' => $pcMapper->getList());

    }
    public function editAction(){
//$form=new PcForm;
        $id = $this->params()->fromRoute('id');
        if($pc=$this->getEntity('\PC')->find($id)){
            $form = $this->getServiceLocator()->get('Form\PcForm');
            $form->bind($pc);
            if ($this->request->isPost()) {
                $form->setData($this->request->getPost());
                if ($form->isValid()) {
                    $this->flushEntity($pc); //моя функция. флушит
                    return $this->redirect()->toRoute('meetingroom',array('controller'=>'pc','action'=>'list'));
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
    public function addAction(){
        $form = $this->getServiceLocator()->get('Form\PcForm');
        $pc = $this->getServiceLocator()->get('Entity\PC');
        $form->bind($pc);
        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());
            if ($form->isValid()) {
                $this->flushEntity($pc);
                return $this->redirect()->toRoute('meetingroom',array('controller'=>'pc','action'=>'list'));
            }
        }
        return array(
            'form' => $form,
            'title'=>'Добавление нового компьютера'
        );
    }
    public function deleteAction(){
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