<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 11.09.14
 * Time: 11:33
 */

namespace MeetingRoom\Form;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class UserForm extends Form {



    public function __construct()
    {
        parent::__construct('user');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'type' => 'MeetingRoom\Form\UserFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
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

  /*  public function addElements()
    {
        // File Input
        $file = new Element\File('avatar');
        $file->setLabel('avatar')
            ->setAttribute('method', 'post');
        $this->add($file);
    }*/

}
?>