<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/user[/:action]',
                    'constraints' => array(
                        'action'     => '[a-zA-Z][a-zA-z0-9_0]*',
                    ),
                    'defaults' => array(
                        'controller'    => 'MeetingRoom\Controller\MeetingRoom',
                        'action'        => 'index',
                    ),
                ),
            ),
            'user-add' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/user/add/:id',
                    'constraints' => array(
                        'id'     => '[0-9]*',
                    ),
                    'defaults' => array(
                        'controller'    => 'MeetingRoom\Controller\MeetingRoom',
                        'action'        => 'add',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'MeetingRoom\Controller\MeetingRoom' => 'MeetingRoom\Controller\UserController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'user' => __DIR__ . '/../view',
        ),
    ),
);
