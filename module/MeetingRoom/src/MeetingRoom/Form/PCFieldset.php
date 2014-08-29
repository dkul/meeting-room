<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 11:41
 */

namespace MeetingRoom\Form;

use Zend\Form\Fieldset;
use MeetingRoom\Entity\PC;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;


class PCFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('pc');
        $this->setHydrator(new ClassMethodsHydrator(false))
            ->setObject(new PC());

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
                'label' => 'Is_camera',
            ),
        ));
        $this->add(array(
            'name' => 'is_internet',
            'attributes' => array(
                'type'  => 'checkbox',
            ),
            'options' => array(
                'label' => 'Is_internet',
            ),
        ));
    }

        public function getInputFilterSpecification()
    {
        return array(
            'name' => array(
                'required' => true,
            )
        );
    }
} 