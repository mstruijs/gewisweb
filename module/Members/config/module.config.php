<?php
return array(
    'router' => array(
        'routes' => array(
            'members' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/members',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Members\Controller',
                        'controller'    => 'Members',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/:action]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Members\Controller\Members' => 'Members\Controller\MembersController'
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'members' => __DIR__ . '/../view/'
        )
    )
);
