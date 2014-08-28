<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 11:26
 */

namespace MeetingRoom\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
class MeetingRoomForm extends Form {

    public function __construct()
    {
        parent::__construct('create_room');

        $this->setAttribute('method', 'post')
            ->setHydrator(new ClassMethodsHydrator(false))
            ->setInputFilter(new InputFilter());

        $this->add(array(
            'type' => 'MeetingRoom\Form\RoomFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
       /* $this->add(array(

            'type' => 'MeetingRoom\Form\PcFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));*/


        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Save/Update'
            )
        ));

    }

} 