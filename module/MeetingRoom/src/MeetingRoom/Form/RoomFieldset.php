<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 11:17
 */

namespace MeetingRoom\Form;

use MeetingRoom\Entity\MeetingRoom;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class RoomFieldset extends Fieldset implements InputFilterProviderInterface {

    public function __construct()
    {
        parent::__construct('room');
        $this->setHydrator(new ClassMethodsHydrator(true))
            ->setObject(new MeetingRoom());

        $this->add(array(
            'name' => 'title',
            'options' => array(
                'label' => 'Название комнаты'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));
        $this->add(array(
            'name' => 'place',
            'options' => array(
                'label' => 'Расположение комнаты'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'name' => 'capacity',
            'options' => array(
                'label' => 'Вместимость комнаты'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'type' => 'MeetingRoom\Form\PcFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));

        $this->add(array(
            'name' => 'pc_id',
            'options' => array(
                'label' => 'pc'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return array(
            'title' => array(
                'required' => true,
            ),
            'place' => array(
                'required' => true,
            ),
             'capacity' => array(
                'required' => true,

            ),

        );
    }
}