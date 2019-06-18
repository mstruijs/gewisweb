<?php
return [
    'controllers' => [
        'invokables' => [
            'Option\Controller\OptionCalendar' => 'Option\Controller\OptionCalendarController',
        ],
    ],
    'router' => [
        'routes' => [
            'option' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/option',
                    'defaults' => [
                        '__NAMESPACE__' => 'Option\Controller',
                    ],
                ],
                'may_terminate' => true,
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
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'delete' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => 'delete',
                            'defaults' => [
                                'action' => 'delete',
                            ]
                        ]
                    ],
                ]

            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'activity' => __DIR__ . '/../view/'
        ]
    ],
    'doctrine' => [
        'driver' => [
            'Option\option_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Option/Model/']
            ],
            'orm_default' => [
                'drivers' => [
                    'Option\Model' => 'Option\option_entities'
                ]
            ]
        ]
    ]
];
