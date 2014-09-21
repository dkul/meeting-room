<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 10.09.14
 * Time: 21:50
 */

namespace MeetingRoom\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use MeetingRoom\Entity\User;

class UserFieldset extends Fieldset implements InputFilterProviderInterface {
    public function __construct()
    {
        parent::__construct('user_fieldset');
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
        $this->add(array(
            'name' => 'fio',
            'type'  => 'text',
            'options' => array(
                'label' => 'Fio'
            ),
        ));
        $this->add(array(
            'name' => 'email',
            'type'  => 'text',
            'options' => array(
                'label' => 'Email'
            ),
        ));
        $this->add([
            'name' => 'role',
            'type'  => 'Select',
            'options' => array(
                'label' => 'Role',
                'empty_option' => 'Please choose your role',
                'value_options' => array(
                    'Administrator' => 'Администратор',
                    'Initiator' => 'Инициатор',
                    'Observer' => 'Наблюдатель',
                    )
            ),

        ]);
        $this->add(array(
            'name' => 'post',
            'type'  => 'select',
            'options' => array(
                'label' => 'Post',
                'empty_option' => 'Please choose your post',
                'value_options' => array(
                    'Manager'=> 'Менеджер',
                    'TeamLeader'=>'Лидер команды',
                    'LeadingDeveloper'=>'Ведущий разработчик',
                    'Developer' =>'Разработчик',
                    'Intern'=>'Стажер'
                )
            ),
        ));
        $this->add(array(
            'name' => 'avatar',
            'type'  => 'image',
            'options' => array(
                'label' => 'Avatar'
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
            'login' => array(
                'required' => true,
            ),
            'password' => array(
                'required' => true,
            ),
            'fio' => array(
                'required' => true,
            ),
            'email' => array(
                'required' => true,
            ),
            /*'post' => array(
                'required' => true,
            ),
            'role' => array(
                'required' => true,
            ),*/
            'avatar' => array(
                'required' => true,
            )
        );
    }
} 