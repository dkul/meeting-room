<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.08.14
 * Time: 10:48
 */

namespace MeetingRoom\Controller;



use MeetingRoom\Form\PcAddForm;
use MeetingRoom\Model\MeetingRoomList;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use \MeetingRoom\Form\PcForm ;
use \MeetingRoom\Form\PcFilter;
use MeetingRoom\Entity\PC;

use MeetingRoom\Form\PcFieldset as PcFieldset;


class PcController extends AbstractActionController {


    public function addAction()
    {
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $request=$this->getRequest();


        $form=new PcAddForm();
        $formInputFilter=new PcFilter();
        $form->setInputFilter($formInputFilter->getInputFilter());



        if($request->isPost()){
        $form->setData($request->getPost());

        if( $form->isValid())
        {

            echo 'Valid';


        }

        else
        {
            echo "Error validate!";
        }


}
        $data=array(

            'title'=>'Form create PC',
            'form'=>$form
        );

        return $data;




    }

    public function editAction()
    {

        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $form=new PcForm();

            $pc= new PC();

           $form->bind($pc);
            if ($this->request->isPost()) {
                $form->setData($this->request->getPost());

                if ($form->isValid()) {
                    var_dump($pc);



                    $entityManager->persist($pc);
                    $entityManager->flush();
                }

                else
                {echo "Error validate!";}
            }

            return array(
                'form' => $form
            );






// отображение данных PC
    }

    public function indexAction()
    {


        $pcMapper=$this->getServiceLocator()->get('MeetingRoom\Mapper\PC');
        return array('listMeetingRoom' => $pcMapper->getList());


        //список PC
    }

    public function deleteAction()
    {

    }
} 