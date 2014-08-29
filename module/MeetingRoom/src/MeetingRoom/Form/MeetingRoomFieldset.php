<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kuleshov
 * Date: 29.08.14
 * Time: 5:26
 * To change this template use File | Settings | File Templates.
 */

namespace MeetingRoom\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use MeetingRoom\Entity\MeetingRoom;

class MeetingRoomFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct()
    {
        parent::__construct('mr_fieldset');
        $this->setHydrator(new ClassMethodsHydrator(true))
             ->setObject(new MeetingRoom());

        $this->add(array(
            'name' => 'title',
            'type'  => 'text',
            'options' => array(
                'label' => 'Title'
            ),
        ));
        $this->add(array(
            'name' => 'place',
            'type'  => 'text',
            'options' => array(
                'label' => 'Place',
            ),
        ));
        $this->add(array(
            'name' => 'capacity',
            'type'  => 'text',
            'options' => array(
                'label' => 'Capacity',
            ),
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
            'capacity' => array(
                'filters'  => array(
                    array('name' => 'Zend\Filter\StringTrim'),
                ),
                'validators' => array(
                    array('name' => 'Zend\Validator\Digits')
                ),
            ),
        );
    }
}