<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 12:02
 */

namespace MeetingRoom\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class MeetingRoomController extends AbstractActionController{
    public  function addAction(){
        $form = $this->getServiceLocator()->get('Form\MeetingRoomForm');

        $pc = $this->getServiceLocator()->get('Entity\PC');
        $meetingRoom=$this->getServiceLocator()->get('Entity\MeetingRoom');

        $pc->setId(15);
        $pc->getId();
       // var_dump($pc);

        $form->bind($meetingRoom);

        //$form->bind($pc);

        if ($this->request->isPost()) {

            $form->setData($this->request->getPost());
            if ($form->isValid()) {
                $meetingRoom = $form->getData();
                $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

                $pc = $meetingRoom->getPc();
                $entityManager->persist($pc);
                $entityManager->flush();

                $meetingRoom->setPc($pc);

                $entityManager->persist($meetingRoom);
                $entityManager->flush();
                echo "Yohoo!";
                // return $this->redirect()->toRoute('rooms',array('controller'=>'pc','action'=>'list'));
            }
        }

        return array(
            'form' => $form,
            'title'=>'Добавление новой комнаты'
        );
    }

} 