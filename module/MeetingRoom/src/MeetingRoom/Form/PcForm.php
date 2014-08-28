<?php

namespace MeetingRoom\Form;

use Zend\Form\Form;

use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
class PcForm extends Form{
    /*  public function __construct()
      {

          parent::__construct('pc');
          $this->setAttribute('method', 'post');
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
                  'label' => 'Tittle',
              ),
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
                  'label' => 'Is Internet',
              ),
          ));
          $this->add(array(
              'name' => 'submit',
              'attributes' => array(
                  'type'  => 'submit',
                  'value' => 'Save',
                  'id' => 'submitbutton',
              ),
          ));
      }

}
class CreatePc extends Form
{
*/
    public function __construct()
    {
        parent::__construct('create_pc');

        $this->setAttribute('method', 'post')
            ->setHydrator(new ClassMethodsHydrator(true))
            ->setInputFilter(new InputFilter());

        $this->add(array(
            'type' => 'MeetingRoom\Form\PcFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));

         $this->add(array(
             'type' => 'Zend\Form\Element\Csrf',
             'name' => 'csrf'
         ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Send'
            )
        ));
        }
    }
