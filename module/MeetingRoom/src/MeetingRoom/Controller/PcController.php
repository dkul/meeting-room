<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace MeetingRoom\Controller;


use MeetingRoom\Model\MeetingRoomList;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MeetingRoom\Entity\MeetingRoom as MeetingRoomEntity;
use MeetingRoom\Entity\PC;

use MeetingRoom\Form\PcForm;
use MeetingRoom\Form\PcFilter;
/*use Application\Grid\AbstractGrid;*/

class PcController extends AbstractActionController
{
    public function indexAction()
    {
        $this->redirect()->toRoute('pc', array('action' => 'list'));
    }

    public function addAction()
    {
        $pcForm   = $this->getServiceLocator()->get('MeetingRoom\Form\Pc');
        $pcMapper = $this->getServiceLocator()->get('MeetingRoom\Mapper\Pc');

        if($this->request->isPost()){
            $pcForm->setData($this->request->getPost());
            if($pcForm->isValid()){
                $pcMapper->save($pcForm->getData());
                $this->redirect()->toRoute('pc', array('action' => 'list'));
            }
        }

        $view = new ViewModel(array(
            'form' => $pcForm
        ));
        $view->setTemplate('meeting-room/pc/form/pc-form');
        return $view;
    }

    public function editAction()
    {

        $pcFormE   = $this->getServiceLocator()->get('MeetingRoom\Form\Pc');
        $pcMapperE = $this->getServiceLocator()->get('MeetingRoom\Mapper\Pc');


        $id = $this->params()->fromRoute('id');

        if(!empty($id)){
            $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $result = $entityManager->getRepository('MeetingRoom\Entity\PC')->find($id);
            $data = array('result' => $result);
        }

        $pcFormE->bind($result);

        if($this->request->isPost()){
                $pcFormE->setData($this->request->getPost());
                if($pcFormE->isValid()){
                    $pcMapperE->save($pcFormE->getData());
                    $this->redirect()->toRoute('pc', array('action' => 'list'));
                }
            }

        $view = new ViewModel(array(
            'form' => $pcFormE
        ));
        $view->setTemplate('meeting-room/pc/form/pc-form');
        return $view;

    }

    public function deleteAction()
    {

    }

    public function listAction()
    {
        /** @var \MeetingRoom\Mapper\PcMapper $pcMapper */
        $pcMapper = $this->getServiceLocator()->get('MeetingRoom\Mapper\Pc');
        return array('listPc' => $pcMapper->getList());
    }
}
