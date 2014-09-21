<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 17.09.14
 * Time: 16:07
 */

namespace MeetingRoom\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class UserAuthForm extends Form {

    public function __construct()
    {
        parent::__construct('user');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'type' => 'MeetingRoom\Form\UserAuthFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Save',
                'id' => 'submitbutton',
            ),
        ));
    }

} 