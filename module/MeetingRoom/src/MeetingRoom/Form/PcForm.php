<?php
/**
 * Created by PhpStorm.
 * User: helen
 * Date: 27.08.14
 * Time: 19:31
 */
namespace MeetingRoom\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class PcForm extends Form{

    public function __construct()
    {
        parent::__construct('create_pc');
        $this->setAttribute('method', 'post')
            ->setHydrator(new ClassMethodsHydrator(false))
            ->setInputFilter(new InputFilter());

        $this->add(array(
            'type' => 'MeetingRoom\Form\PcFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Save/Update'
            )
        ));
    }
} 