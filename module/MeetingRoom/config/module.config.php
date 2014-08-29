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
                        'controller' => 'MeetingRoom\Controller\pc',
                        'action'     => 'index',
                    ),
                ),
            ),

        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'MeetingRoom\Controller\Index' => 'MeetingRoom\Controller\IndexController',
            'MeetingRoom\Controller\pc' => 'MeetingRoom\Controller\PCController'
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
            },
            '\Form\PcForm' => function()
                {
                    return new \MeetingRoom\Form\PcForm();
                },
            '\Form\PC' => function()
                {
                    return new \MeetingRoom\Form\PC();
                },
            'MeetingRoom\Mapper\PC' => function($serviceManager)
                {
                    return new \MeetingRoom\Mapper\PcMapper(
                        $serviceManager->get('Doctrine\ORM\EntityManager')
                    );
                },
            'MeetingRoom\Grid\MeetingRoom' => function($serviceManager)
                {
                    $grid = new \MeetingRoom\Model\MeetingRoomGrid();
                    $grid->setEntityManager($serviceManager->get('Doctrine\ORM\EntityManager'));
                    return $grid;
                },
            'MeetingRoom\Grid\PC' => function($serviceManager)
                {
                    $grid = new \MeetingRoom\Model\PcGrid();
                    $grid->setEntityManager($serviceManager->get('Doctrine\ORM\EntityManager'));
                    return $grid;
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
