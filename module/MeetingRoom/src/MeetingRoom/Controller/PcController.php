<?php

namespace MeetingRoom\Controller;

use Doctrine\ORM\EntityManager;
use MeetingRoom\Form\PcForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MeetingRoom\Entity\PC ;



class PcController extends AbstractActionController
{
    public function indexAction()
    {

        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $listPc = $entityManager->getRepository('MeetingRoom\Entity\PC')->findAll();

        return array('listPc' => $listPc);

    }

    public function addAction()
    {
         $request=$this->getRequest();


         $form = new PcForm();
         $formInputFilter = new PcFilter();
         $form->setInputFilter($formInputFilter->getInputFilter());

         $form ->setData($request->getPost());

         if($request->isPost()){
             $form->setData($request->getPost());

             if($form->isValid()){
                 echo "Validate data!";

             }else{
                 echo "error validate!";
             }}
         $data = array(
             'title'=>'Form create PC',
             'form' => $form
         );

         $view = new ViewModel($data);
         $view->setTemplate('meeting-room/form/add-meeting-room');
         return $view;
    }

    public function editAction()
    {
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $form = new PcForm();
        $pc = new PC();
        $form->bind($pc);

        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                //var_dump($pc);
                $entityManager->persist($pc);
                $entityManager->flush();
              ;
            }
            else{
                echo "kjhghjk";
            }
        }

        return array(
            'form' => $form,
            'title'=>'add new PC'
        );
    }
    public function deleteAction()
    {
        echo "delete";
    }


}