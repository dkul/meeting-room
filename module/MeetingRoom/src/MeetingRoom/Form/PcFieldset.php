<?php
namespace MeetingRoom\Form;

use MeetingRoom\Entity\PC;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class PcFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('pc');
        $this->setHydrator(new ClassMethodsHydrator(false))
            ->setObject(new PC());

        $this->add(array(
            'name' => 'title',
            'options' => array(
                'label' => 'Name of the PC'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'name' => 'is_internet',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'Internet'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'name' => 'is_camera',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'Camera'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        /*$this->add(array(
            'type' => 'Application\Form\BrandFieldset',
            'name' => 'brand',
            'options' => array(
                'label' => 'Brand of the product'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'categories',
            'options' => array(
                'label' => 'Please choose categories for this product',
                'count' => 2,
                'should_create_template' => true,
                'allow_add' => true,
                'target_element' => array(
                    'type' => 'Application\Form\CategoryFieldset'
                )
            )
        ));*/
    }

    /**
     * Should return an array specification compatible with
     * {@link ZendInputFilterFactory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return array(
            'title' => array(
                'required' => true,
            ),
            'is_internet' => array(
                'required' => true,
                /*'validators' => array(
                    array(
                        'name' => 'Float'
                    )
                )*/
            ),
            'is_camera' => array(
                'required' => true,
                /*'validators' => array(
                    array(
                        'name' => 'Float'
                    )
                )*/
            )
        );
    }
}