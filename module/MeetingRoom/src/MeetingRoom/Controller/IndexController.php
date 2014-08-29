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

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $listMeetingRoom = $entityManager->getRepository('MeetingRoom\Entity\MeetingRoom')->findAll();

        return array('listMeetingRoom' => $listMeetingRoom);
    }

    public function addAction()
    {
        $mrForm   = $this->getServiceLocator()->get('MeetingRoom\Form\MeetingRoom');
        /** @var \MeetingRoom\Mapper\MeetingRoomMapper $mrMapper */
        $mrMapper = $this->getServiceLocator()->get('MeetingRoom\Mapper\MeetingRoom');
        /** @var \MeetingRoom\Mapper\PcMapper $pcMapper*/
        $pcMapper = $this->getServiceLocator()->get('MeetingRoom\Mapper\Pc');

        if($this->request->isPost()){
            $post = $this->request->getPost();
            $mrForm->setData($post);
            if($mrForm->isValid()){
                $pcId = (int) $post->mr_fieldset['pc_id'];
                $pc = $pcMapper->getItemById($pcId);
                if($pc){
                    $meetingRoom = $mrForm->getData();
                    $meetingRoom->setPc($pc);
                    $mrMapper->save($meetingRoom);
                    $this->redirect()->toRoute('rooms', array('action' => 'index'));
                }
            }
        }

        $view = new ViewModel(array(
            'form' => $mrForm
        ));
        $view->setTemplate('meeting-room/form/mr-form');
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
}
