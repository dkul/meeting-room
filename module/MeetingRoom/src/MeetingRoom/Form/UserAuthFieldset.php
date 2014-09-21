<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 17.09.14
 * Time: 16:04
 */

namespace MeetingRoom\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use MeetingRoom\Entity\User;


class UserAuthFieldset extends Fieldset implements InputFilterProviderInterface {
    public function __construct()
    {
        parent::__construct('user_auth_fieldset');
        $this->setHydrator(new ClassMethodsHydrator(true))
            ->setObject(new User());

        $this->add(array(
            'name' => 'login',
            'type'  => 'text',
            'options' => array(
                'label' => 'Login'
            ),
        ));
        $this->add(array(
            'name' => 'password',
            'type'  => 'text',
            'options' => array(
                'label' => 'Password'
            ),
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'login' => array(
                'required' => true,
            ),
            'password' => array(
                'required' => true,
            ),
        );
    }
} 