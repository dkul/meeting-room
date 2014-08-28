<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.08.14
<<<<<<< Updated upstream
 * Time: 11:06
=======
 * Time: 10:46
>>>>>>> Stashed changes
 */

namespace MeetingRoom\Controller;

/*use MeetingRoom\Model\MeetingRoomList;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MeetingRoom\Entity\MeetingRoom as MeetingRoomEntity;
use MeetingRoom\Entity\PC;

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
        $data = array(
            'title' => 'Form add meeting room!!!'
        );

        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $pc = new PC();
        $pc->setTitle('PC-235');

        $entityManager->persist($pc);

        $meetingRoom = new MeetingRoomEntity();
        $meetingRoom->setTitle('Альфа6');
        $meetingRoom->setPlace('4 этаж, 103');
        $meetingRoom->setCapacity(4);
        $meetingRoom->setPc($pc);

        $entityManager->persist($meetingRoom);
        $entityManager->flush();

        $data['meeting_room_id'] = $meetingRoom->getId();

        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/form/add-meeting-room');
        return $view;
    }

    public function editAction()
    {
        //параметр из route - id
        $id = $this->params()->fromRoute('id');
        if(!empty($id)){
            $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $result = $entityManager->getRepository('MeetingRoom\Entity\MeetingRoom')->find($id);

            $data = array('result' => $result);
        }else{
            $data = array('error' => 'Input id to URL');
        }

        $view = new ViewModel($data);
        $view->setTemplate('meeting-room/form/edit-meeting-room');
        return $view;
    }

    public function deleteAction()
    {
        $view = new ViewModel(
            array(
                'title' => 'Delete action'
            )
        );
        $view->setTemplate('meeting-room/form/edit-meeting-room');
        $view->setTerminal(true);
        return $view;
    }

    public function listAction(){

    }
}*/

use Doctrine\ORM\EntityManager;
use MeetingRoom\Form\PcForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MeetingRoom\Entity\PC ;


class PcController extends AbstractActionController{
    public function listAction(){

        $listPc=$this->getEntity('\PC')->findAll();
        return array('listPc' => $listPc);
    }
    public function editAction(){
        //$form=new PcForm;
        $id = $this->params()->fromRoute('id');


        //if($pc=$this->getEntity('\PC')->find('id')){
        $pc = new PC();
            $form = $this->getServiceLocator()->get('Form\CreatePc');
            $form->bind($pc);
            if ($this->request->isPost()) {
                $form->setData($this->request->getPost());
                if ($form->isValid()) {
                    $this->flushEntity($pc);
                    return $this->redirect()->toRoute('rooms',array('controller'=>'pc','action'=>'list'));
                }
            }

            return array(
                'form'=>$form,
                'pc'=>$pc


            );
        //}
        return array(
            'error'=>'Нет компьютера с указанным id.'
        );



    }
    public  function addAction(){
        $form = $this->getServiceLocator()->get('Form\CreatePc');
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

