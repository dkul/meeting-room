<?php
namespace MeetingRoom;

return array(
    'router' => array(
        'routes' => array(
            'rooms' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/room[/:action][/:id]',
                    'constraints' => array(
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'         => '[0-9]*'
                    ),
                    'defaults' => array(
                        'controller' => 'MeetingRoom\Controller\Index',
                        'action'     => 'index',
                    ),
                ),

            ),
            'pc' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/room/pc[/:action][/:id]',
                    'constraints' => array(
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'         => '[0-9]*'
                    ),
                    'defaults' => array(
                        'controller' => 'MeetingRoom\Controller\Pc',
                        'action'     => 'index',
                    ),
                ),

            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'MeetingRoom\Controller\Index' => 'MeetingRoom\Controller\IndexController',
            'MeetingRoom\Controller\Pc' => 'MeetingRoom\Controller\PcController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'meeting-room' => __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'mylowercase' => 'MeetingRoom\View\Helper\LowerCase'
        )
    ),
    'controller_plugins' => array(
        'invokables' => array(
            'myFirstPlugin' => 'MeetingRoom\Controller\Plugins\MyFirstPlugin'
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'Model\MeetingRoomList' => function(){
                return new \MeetingRoom\Model\MeetingRoomList();
            }
        )
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/MeetingRoom/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    )
);
