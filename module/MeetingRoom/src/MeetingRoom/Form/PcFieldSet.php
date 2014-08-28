<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 10:46
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

        /*$this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));*/

        $this->add(array(
            'name' => 'title',
            'attributes'=>array(
                'required'=>'required'
            ),
            'options' => array(
                'label' => 'Title',
            ),
        ));
        $this->add(array(
            'name' => 'is_camera',

            'type'  => 'checkbox',

            'options' => array(
                'label' => 'Is Camera',
            ),
        ));
        $this->add(array(
            'name' => 'is_internet',

              'type'  => 'checkbox',

            'options' => array(
                'label' => 'Is Internet',
            ),
        ));


    }

    public function getInputFilterSpecification()
    {
        return array(
            'title' => array(
                'required' => true
            ),
            'is_internet' => array(
                'required' => false
            ),
            'is_camera' => array(
                'required' =>false
            )
        );
    }

} 