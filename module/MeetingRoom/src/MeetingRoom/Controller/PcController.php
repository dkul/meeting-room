<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.08.14
 * Time: 10:48
 */

namespace MeetingRoom\Controller;



use MeetingRoom\Model\MeetingRoomList;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use \MeetingRoom\Form\PcForm ;
use \MeetingRoom\Form\PcFilter;
use MeetingRoom\Entity\PC;


class PcController extends AbstractActionController {


    public function addAction()
    {

        $request=$this->getRequest();


        $form=new PcForm();
        $formInputFilter=new PcFilter();
        $form->setInputFilter($formInputFilter->getInputFilter());

        $form->setData($request->getPost());

        if( $form->isValid())
        {

            echo 'Valid';
        }

        else
        {
            echo "Error validate!";
        }

        $data=array(

            'title'=>'Form create PC',
            'form'=>$form
        );

        return $data;




    }

    public function editAction()
    {
        $id= $this->params()->fromRoute('id');
        if(!empty($id))
        {

            $entityManager=$this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $result=$entityManager->getRepository('MeetingRoom\Entity\MeetingRoom')->find($id);


            $data=array('meetingRoom'=>$result);}






// отображение данных PC
    }

    public function indexAction()
    {


        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $listMeetingRoom = $entityManager->getRepository('MeetingRoom\Entity\PC')->findAll();

        return array('listMeetingRoom' => $listMeetingRoom);

        //список PC
    }

    public function deleteAction()
    {

    }
} 