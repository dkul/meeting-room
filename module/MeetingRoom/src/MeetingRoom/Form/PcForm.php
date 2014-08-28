<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.08.14
 * Time: 12:21
 */

namespace MeetingRoom\Form;

use Zend\Form\Form;
use Zend\InputFilter\Input;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class PcForm extends Form{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('pc');
        $this->setAttribute('method', 'post');
           // ->setHydrator(new ClassMethodsHydrator(true));



        $this->add(array(
            'type' => 'MeetingRoom\Form\PcFieldSet',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));

       /* $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf'
        ));*/


        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Save',
                'id' => 'submit_button',
            ),
        ));
    }

}