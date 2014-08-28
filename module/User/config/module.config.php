<?php

return array(
    'router' => array(
        'routes' => array(
            'user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/user[/:action][/:id]',
                    'constraints' => array(
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'         => '[0-9]*'
                    ),
                    'defaults' => array(
                        'controller' => 'User\Controller\User',
                        'action'     => 'index',
                    ),
                ),
            )
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'User\Controller\User' => 'User\Controller\UserController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'user' => __DIR__ . '/../view',
        ),
    ),
);
