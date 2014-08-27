<?php
/**
 * Created by PhpStorm.
 * User: helen
 * Date: 27.08.14
 * Time: 19:26
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
        $this->setHydrator(new ClassMethodsHydrator(false))
            ->setObject(new PC());

        $this->add(array(
            'name' => 'title',
            'options' => array(
                'label' => 'Title'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

       /* $this->add(array(
            'name' => 'is_internet',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'Наличие интернета'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'name' => 'is_camera',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'Наличие камеры'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));*/

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