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
use MeetingRoom\Entity\MeetingRoom;
use Base\Mapper\EntityManagerAwareInterface;
use Doctrine\ORM\EntityManager;

class MeetingRoomFieldset extends Fieldset implements InputFilterProviderInterface, EntityManagerAwareInterface
{
    protected $entityManager;

    public function __construct(EntityManager $em)
    {
        $this->setEntityManager($em);

        parent::__construct('mr_fieldset');
        $this->setHydrator(new ClassMethodsHydrator(true))
             ->setObject(new MeetingRoom());

        $this->add(array(
            'name' => 'title',
            'type'  => 'text',
            'options' => array(
                'label' => 'Title'
            ),
        ));
        $this->add(array(
            'name' => 'place',
            'type'  => 'text',
            'options' => array(
                'label' => 'Place',
            ),
        ));
        $this->add(array(
            'name' => 'capacity',
            'type'  => 'text',
            'options' => array(
                'label' => 'Capacity',
            ),
        ));

        $this->add(array(
            'type'    => 'Zend\Form\Element\Select',
            'name'    => 'pc_id',
            'options' => array(
                'label'          => 'Select PC',
                'value_options'  => $this->getOptionsForSelect(),
                'empty_option'   => '--- please choose ---'
            ),
        ));
        $this->add(array(
            'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
            'name'    => 'pc_id',
            'options' => array(
                'label'          => 'Select PC',
                'object_manager' => $this->getEntityManager(),
                'target_class'   => 'MeetingRoom\Entity\PC',
                'property'       => 'title',
                'empty_option'   => '--- please choose ---'
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
            ),
            'capacity' => array(
                'filters'  => array(
                    array('name' => 'Zend\Filter\StringTrim'),
                ),
                'validators' => array(
                    array('name' => 'Zend\Validator\Digits')
                ),
            ),
        );
    }

    public function setEntityManager(EntityManager $em){
        $this->entityManager = $em;
    }

    public function getEntityManager(){
        return $this->entityManager;
    }

    public function getOptionsForSelect(){
        $selectData = array(
           1 => 'Test'
        );
        return $selectData;
    }
}