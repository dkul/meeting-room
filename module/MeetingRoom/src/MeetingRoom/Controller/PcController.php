<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.08.14
 * Time: 10:46
 */

namespace MeetingRoom\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MeetingRoom\Entity\PC;


class PcController extends AbstractActionController{
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
    public  function addAction(){
        return new ViewModel();
    }

    public  function deleteAction(){
        return new ViewModel();
    }
    public function getEntity($entity){
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        return $entityManager->getRepository('MeetingRoom\Entity'.$entity);
    }

} 