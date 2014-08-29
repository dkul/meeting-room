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
use MeetingRoom\Entity\PC;

class PcFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct()
    {
        parent::__construct('pc_fieldset');
        $this->setHydrator(new ClassMethodsHydrator(true))
             ->setObject(new PC());

        $this->add(array(
            'name' => 'title',
            'type'  => 'text',
            'options' => array(
                'label' => 'Title'
            ),
        ));
        $this->add(array(
            'name' => 'is_camera',
            'type'  => 'checkbox',
            'options' => array(
                'label' => 'Is camera',
            ),
        ));
        $this->add(array(
            'name' => 'is_internet',
            'type'  => 'checkbox',
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
    }
}