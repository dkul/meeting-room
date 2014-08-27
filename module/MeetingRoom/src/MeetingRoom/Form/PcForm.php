<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.08.14
 * Time: 12:21
 */

namespace MeetingRoom\Form;

use Zend\Form\Form;

class PcForm  extends Form{
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
            'label' => 'title',
        ),
    ));
    $this->add(array(
        'name' => 'is internet',
        'attributes' => array(
            'type'  => 'checkbox',
        ),
        'options' => array(
            'label' => 'is Internet',
        ),
    ));
    $this->add(array(
        'name' => 'is camera',
        'attributes' => array(
            'type'  => 'checkbox',
        ),
        'options' => array(
            'label' => 'is camera',
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