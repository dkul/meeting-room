<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.08.14
 * Time: 12:20
 */

namespace MeetingRoom\Form;

use Zend\Form\Form;

class PcForm extends Form
{
    public function __construct()
    {
        parent::__construct('pc');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'type' => 'MeetingRoom\Form\PcFieldset',
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