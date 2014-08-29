<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.08.14
 * Time: 12:20
 */

namespace MeetingRoom\Form;

use Doctrine\ORM\EntityManager;
use Zend\Form\Form;
use MeetingRoom\Form\MeetingRoomFieldset;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MeetingRoomForm extends Form implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;

    public function __construct(ServiceLocatorInterface $serviceLocator)
    {
        $this->setServiceLocator($serviceLocator);

        parent::__construct('mr');
        $this->setAttribute('method', 'post');

        $meetingRoomFieldset = new MeetingRoomFieldset($this->getServiceLocator());
        $meetingRoomFieldset->setOptions(array(
            'use_as_base_fieldset' => true
        ));
        $this->add($meetingRoomFieldset);

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