<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 11:25
 */

namespace MeetingRoom\Form;

use MeetingRoom\Entity\PC;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;


class PcFieldSet extends Fieldset implements InputFilterProviderInterface {

    public function __construct()
    {
        parent::__construct('pc');
        $this->setHydrator(new ClassMethodsHydrator(true))
            ->setObject(new PC());

        $this->add(array(
            'name' => 'title',
            'options' => array(
                'label' => 'title'
            ),
            'attributes' => array(
                'required' => 'required'
            )
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
                'label' => 'Is internet',
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
            )
        );

        // TODO: Implement getInputFilterSpecification() method.
    }
}