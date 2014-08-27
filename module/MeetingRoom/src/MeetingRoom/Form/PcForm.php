<?php

namespace MeetingRoom\Form;

use Zend\Form\Form;

class PcForm extends Form{
public function __construct()
{
parent::__construct('album');
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
        'label' => 'Tittle',
    ),
));
$this->add(array(
    'name' => 'is_camera',
    'attributes' => array(
        'type'  => 'checkbox',
    ),
    'options' => array(
        'label' => 'Is camera',
    ),
));
    $this->add(array(
        'name' => 'is_internet',
        'attributes' => array(
            'type'  => 'checkbox',
        ),
        'options' => array(
            'label' => 'Is Internet',
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
    }}