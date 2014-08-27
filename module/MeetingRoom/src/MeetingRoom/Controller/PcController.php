<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.08.14
 * Time: 11:34
 */

namespace MeetingRoom\Controller;


use MeetingRoom\Model\MeetingRoomList;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MeetingRoom\Entity\MeetingRoom as MeetingRoomEntity;
use MeetingRoom\Entity\PC;
use MeetingRoom\Form\PcForm;


class PcController extends AbstractActionController{


    public function indexAction()
    {
        /*$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $listPC = $entityManager->getRepository('MeetingRoom\Entity\PC')->findAll();

        return array('listPC' => $listPC);*/
        $request = $this->getRequest();

        $form = new PcForm();
        $formInputFilter = new PcFilter();
        $form->setInputFilter($formInputFilter->getInputFilter());

        $form->setData($request->getPost());

        if($form->isValid()){
            echo 'VALIDATE DATA!';
        }else{
            echo 'Not Valid!';
        }

        $data = array(
            'title'=>'Form create PC',
            'form'=>$form
        );

        return $data;

    }

} 