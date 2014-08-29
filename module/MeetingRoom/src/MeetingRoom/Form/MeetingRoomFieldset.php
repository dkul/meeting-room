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
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use MeetingRoom\Entity\MeetingRoom;
use Base\Mapper\EntityManagerAwareInterface;
use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

class MeetingRoomFieldset extends Fieldset implements InputFilterProviderInterface, ServiceLocatorAwareInterface
{
    protected $serviceLocator;

    public function __construct(ServiceLocatorInterface $serviceLocator)
    {
        $this->setServiceLocator($serviceLocator);

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
        /*$this->add(array(
            'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
            'name'    => 'pc_id',
            'options' => array(
                'label'          => 'Select PC',
                'object_manager' => $this->getEntityManager(),
                'target_class'   => 'MeetingRoom\Entity\PC',
                'property'       => 'title',
                'empty_option'   => '--- please choose ---'
            ),
        ));*/
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

    /**
     * @return array
     */
    public function getOptionsForSelect(){
        $selectData = array();
        /** @var \MeetingRoom\Mapper\PcMapper $pcMapper */
        $pcMapper = $this->getServiceLocator()->get('MeetingRoom\Mapper\Pc');
        $listPc = $pcMapper->getListNotUsed();
        if($listPc){
            foreach($listPc as $pc){
                $selectData[$pc->getId()] = $pc->getTitle();
            }
        }
        return $selectData;
    }

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}