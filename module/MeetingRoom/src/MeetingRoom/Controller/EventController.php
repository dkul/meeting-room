<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 19.09.14
 * Time: 16:43
 */

namespace MeetingRoom\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class EventController extends AbstractActionController {

    public function indexAction()
    {
        $this->redirect()->toRoute('home', array('action' => 'index'));
    }

    public function addAction()
    {

        $eventForm   = $this->getServiceLocator()->get('MeetingRoom\Form\Event');

        $eventMapper = $this->getServiceLocator()->get('MeetingRoom\Mapper\Event');
        $mrMapper = $this->getServiceLocator()->get('MeetingRoom\Mapper\MeetingRoom');


        if($this->request->isPost()){
            $post = $this->request->getPost();
            $eventForm->setData($post);
            if($eventForm->isValid()){
                $mrId = (int) $post->event_fieldset['meeting_room_id'];
                $mr = $mrMapper->getItemById($mrId);
                if($mr){
                    $event = $eventForm->getData();
                    $event->setPc($mr);
                    $eventMapper->save($event);
                    $this->redirect()->toRoute('home', array('action' => 'index'));
                }
            }
        }

        /*if($this->request->isPost()){
            $eventForm->setData($this->request->getPost());
            if($eventForm->isValid()){
                $eventMapper->save($eventForm->getData());
                $this->redirect()->toRoute('home', array('action' => 'index'));
            }
        }*/

        $view = new ViewModel(array(
            'form' => $eventForm
        ));
        $view->setTemplate('meeting-room/event/form/event-form');
        return $view;
    }
} 