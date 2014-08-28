<?php

namespace MeetingRoom\Form;

use MeetingRoom\Entity\PC;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class PcFieldset extends Fieldset implements InputFilterProviderInterface {

    public function __construct()
    {
        parent::__construct('pc');
        $this->setHydrator(new ClassMethodsHydrator(true))
            ->setObject(new PC());

        $this->add(array(
            'name' => 'title',
            'options' => array(
                'label' => 'Title'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'name' => 'is_internet',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'is internet',
                'required' => false
            ),
        ));

        $this->add(array(
            'name' => 'is_camera',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'is camera',
                'required' => false
            ),
        ));

    }

    public function getInputFilterSpecification()
    {
        return array(
            'title' => array(
                'required' => true,
            )
        );
    }
}