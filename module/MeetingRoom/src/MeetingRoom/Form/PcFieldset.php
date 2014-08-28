<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 11:06
 */

namespace MeetingRoom\Form;

use MeetingRoom\Entity\PC;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class PcFieldset extends Fieldset implements InputFilterProviderInterface {

    public function __construct()
    {
        parent::__construct('pc');
        $this->setHydrator(new ClassMethodsHydrator(true))
            ->setObject(new PC());

        $this->add(array(
            'name' => 'title',
            'options' => array(
                'label' => 'Имя компа '
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'name' => 'is_internet',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'интернет ',
            ),
        ));

        $this->add(array(
            'name' => 'is_camera',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'камера ',
            ),
        ));

    }

    public function getInputFilterSpecification()
    {
        return array(
            'title' => array(
                'required' => true,
            )
        );
    }
}