<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.08.14
 * Time: 13:09
 */

namespace MeetingRoom\Form;

use Zend\Form\Form;
class PcForm extends Form{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('PcForm');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Title',
            ),
        ));
        $this->add(array(
            'name' => 'is_camera',
            'attributes' => array(
                'type'  => 'checkbox',
            ),
            'options' => array(
                'label' => 'IsCamera',
            ),
        ));
        $this->add(array(
            'name' => 'is_internet',
            'attributes' => array(
                'type'  => 'checkbox',
            ),
            'options' => array(
                'label' => 'IsInternet',
            ),
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