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

class MeetingRoomForm extends Form
{
    public function __construct(EntityManager $em)
    {
        parent::__construct('mr');
        $this->setAttribute('method', 'post');

        $meetingRoomFieldset = new MeetingRoomFieldset($em);
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
} 