<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 19.09.14
 * Time: 16:56
 */

namespace MeetingRoom\Form;
use Doctrine\ORM\EntityManager;
use Zend\Form\Form;
use MeetingRoom\Form\EventFieldset;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EventForm extends Form implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;

    public function __construct(ServiceLocatorInterface $serviceLocator)
    {
        $this->setServiceLocator($serviceLocator);

        parent::__construct('event');
        $this->setAttribute('method', 'post');


        $eventFieldset = new EventFieldset($this->getServiceLocator());
        die();
        /*$eventFieldset = new EventFieldset($this->getServiceLocator());
        $eventFieldset->setOptions(array(
            'use_as_base_fieldset' => true
        ));*/

        $this->add($eventFieldset);

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Save',
                'id' => 'submitbutton',
            ),
        ));
    }

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}