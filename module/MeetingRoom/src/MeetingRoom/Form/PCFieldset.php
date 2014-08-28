<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 12:39
 */
namespace MeetingRoom\Form;

use MeetingRoom\Entity\Product;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class PCFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('product');
        $this->setHydrator(new ClassMethodsHydrator(false))
            ->setObject(new Product());

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
                'label' => 'Title',
            ),
        ));
        $this->add(array(
            'name' => 'is_camera',
            'attributes' => array(
                'type'  => 'checkbox',
            ),
            'options' => array(
                'label' => 'Is_Camera',
            ),
        ));
        $this->add(array(
            'name' => 'is_internet',
            'attributes' => array(
                'type'  => 'checkbox',
            ),
            'options' => array(
                'label' => 'Is_Internet',
            ),
        ));
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
    \*/

    public function getInputFilterSpecification()
    {
        return array(
            'title' => array(
                'required' => true,
            ),
        );
    }
}