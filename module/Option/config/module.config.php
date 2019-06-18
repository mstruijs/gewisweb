<?php
return [
    'router' => [
        'routes' => [
            'option_calendar' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/option/calendar/',
                    'defaults' => [
                        '__NAMESPACE__' => 'Option\Controller',
                        'controller' => 'optionCalendar',
                        'action' => 'index'
                    ],
                ],
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
