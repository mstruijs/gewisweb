<?php
return [
    'router' => [
        'routes' => [
            'option' => [
                'type' => 'Literal',
                'priority' => 100,
                'may_terminate' => true,
                'options' => [
                    'route' => '/option',
                    'defaults' => [
                        '__NAMESPACE__' => 'ActivityOption\Controller',
                    ],
                ],
                'child_routes' => [
                    'calendar' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/calendar',
                            'defaults' => [
                                'controller' => 'optionCalendar',
                                'action' => 'index'
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/delete',
                            'defaults' => [
                                'controller' => 'optionCalendar',
                                'action' => 'delete',
                            ]
                        ]
                    ],
                ]

            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            'ActivityOption\Controller\OptionCalendar' => 'ActivityOption\Controller\OptionCalendarController',
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'option' => __DIR__ . '/../view/'
        ]
    ],
    'doctrine' => [
        'driver' => [
            'Option\option_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/ActivityOption/Model/']
            ],
            'orm_default' => [
                'drivers' => [
                    'ActivityOption\Model' => 'ActivityOption\option_entities'
                ]
            ]
        ]
    ]
];
