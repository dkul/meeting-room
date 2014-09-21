<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 19.09.14
 * Time: 16:55
 */

namespace MeetingRoom\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Base\Mapper\EntityManagerAwareInterface;
use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use MeetingRoom\Entity\Table;
use Zend\ServiceManager\ServiceLocatorInterface;



class EventFieldset  extends Fieldset implements InputFilterProviderInterface, ServiceLocatorAwareInterface {

    protected $serviceLocator;

    public function __construct(ServiceLocatorInterface $serviceLocator)
    {
        $this->setServiceLocator($serviceLocator);

        parent::__construct('event_fieldset');
        $this->setHydrator(new ClassMethodsHydrator(true))
            ->setObject(new Table());

        $this->add(array(
            'name' => 'type',
            'type'  => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Type',
                'empty_option' => 'Please choose type',
                'value_options' => array(
                    'Meeting '=> 'Встреча',
                    'Clients '=>'Переговоры с клиентами',
                    'Interview'=>'Собеседование',
                )
            ),
        ));

        $this->add(array(
            'name' => 'time',
            'type'  => 'datetime',
            'options' => array(
                'label' => 'time'
            ),
        ));
        $this->add(array(
            'type'    => 'Zend\Form\Element\Select',
            'name'    => 'meeting_room_id',
            'options' => array(
                'label'          => 'Select Meeting Room',
                'value_options'  => $this->getOptionsForSelectMR(),
                'empty_option'   => '--- please choose ---'
            ),
        ));
        $this->add(array(
            'type'    => 'Select',
            'name'    => 'user_id',
            'options' => array(
                'label'          => 'Select Meeting Room',
                'value_options'  => $this->getOptionsForSelectU(),
                'empty_option'   => '--- please choose ---'
            ),
        ));
        $this->add([
            'name' => 'description',
            'type'  => 'text',
            'options' => array(
                'label' => 'Description'
            ),

        ]);
        $this->add(array(
            'name' => 'status',
            'type'  => 'select',
            'options' => array(
                'label' => 'Status',
                'empty_option' => 'Please choose your status',
                'value_options' => array(
                    'Reservation '=> 'Бронь',
                    'Approved '=>'Утверждено',
                    'Declined'=>'Отклонено',

                )
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
            'type' => array(
                'required' => true,
            )
        );
    }


    /**
     * @return array
     */
    public function getOptionsForSelectMR()
    {
        $selectData = array();
        $mrMapper = $this->getServiceLocator()->get('MeetingRoom\Mapper\MeetingRoom');
        $listMR = $mrMapper->getListNotUsed();
        if($listMR){
            foreach($listMR as $mr){
                $selectData[$mr->getId()] = $mr->getTitle();
            }
        }
        return $selectData;
    }

    /**
     * @return array
     */
    public function getOptionsForSelectU()
    {
        $selectData = array();
        /** @var \MeetingRoom\Mapper\MeetingRoomMapper $mrMapper */
        $mrMapper = $this->getServiceLocator()->get('MeetingRoom\Mapper\User');
        $listMR = $mrMapper->getList();
        if($listMR){
            foreach($listMR as $mr){
                 $selectData[$mr->getId()] = $mr->getLogin();
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

