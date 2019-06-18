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
                        '__NAMESPACE__' => 'Option\Controller',
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
                ],
                'child_routes' => [
                    'delete' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => 'delete',
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
            'Option\Controller\OptionCalendar' => 'Option\Controller\OptionCalendarController',
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
