<?php
namespace MeetingRoom;

return array(
    'router' => array(
        'routes' => array(
            'meetingroom' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/meetingroom[/:controller][/:action][/:id]',
                    'constraints' => array(
                        'controller'=>'[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'         => '[0-9]*'
                    ),
                    'defaults' => array(
                        'controller' => 'MeetingRoom\Controller\MeetingRoom',
                        'action'     => 'list',
                    ),
                ),
            )
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'pc'=>'MeetingRoom\Controller\PCController',
            'index' => 'MeetingRoom\Controller\MeetingRoomController',
            'MeetingRoom\Controller\Index' => 'MeetingRoom\Controller\MeetingRoomController',
            'MeetingRoom\Controller\PC' => 'MeetingRoom\Controller\PCController'
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
            'Form\PcForm'=>function(){
                    return new \MeetingRoom\Form\PcForm();
                },
            'Entity\PC'=>function(){
                    return new \MeetingRoom\Entity\PC();
                },
            'MeetingRoom\Mapper\PC' =>function($serviceManager){

                    return new \MeetingRoom\Mapper\PCMapper(
                        $serviceManager->get('Doctrine\ORM\EntityManager')
                    );

                },
            'MeetingRoom\Grid\MeetingRoom'=>function($serviceManager)
                {
                    $grid=new \MeetingRoom\Model\MeetingRoomGrid();
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

/*
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

);*/