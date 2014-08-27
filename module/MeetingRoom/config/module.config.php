<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace MeetingRoom;
return array(
    'router' => array(
        'routes' => array(
            'meetingrooms' => array(
                'type' => 'Segment',
                'options' => array(

                    'route'    => '/meetingrooms[/:action][/:id]',
                    'constraints' => array(
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'MeetingRoom\Controller\MeetingRoom',
                        'action'     => 'index',
                    ),
                ),
            ),
            'meetingroom' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/meetingroom/pc[/:action][/:id]',
                    'constraints' => array(
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'         => '[0-9]*'
                    ),
                    'defaults' => array(
                        'controller' => 'MeetingRoom\Controller\PC',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables'=> array(
            'MeetingRoom\Controller\MeetingRoom' => 'MeetingRoom\Controller\MeetingRoomController',
            'MeetingRoom\Controller\PC' => 'MeetingRoom\Controller\PCController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'meeting-room' => __DIR__ . '/../view'
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'mylowercase' => 'MeetingRoom\View\Helper\LowerCase'
        )
    ),
    'controller_plugins' => array(
        'invokables' => array(
            'myFirstPlugin'=> 'MeetingRoom\Controller\Plugins\MyFirstPlugin'
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'Model\MeetingRoomList' => function() {
                    return new \MeetingRoom\Model\MeetingRoomList();
                }
        )
    ),
    'doctrine' =>array(
        'driver'=>array(
            __NAMESPACE__ . 'driver'=>array(
                'class'=> 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache'=>'array',
                'paths'=>array(__DIR__ . '/../src/MeetingRoom/Entity')

            ),

            'orm_default'=>array(
                'drivers'=>array(
                    __NAMESPACE__ . '\Entity'=> __NAMESPACE__ . 'driver'
                ),
            ),
        ),
    )

);
