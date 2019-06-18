<?php
namespace ActivityOption;

class Module
{

    /**
     * Get the autoloader configuration.
     *
     * @return array Autoloader config
     */
    public function getAutoloaderConfig()
    {
        if (APP_ENV === 'production') {
            return [
                'Zend\Loader\ClassMapAutoloader' => [
                    __DIR__ . '/autoload_classmap.php',
                ]
            ];
        }

        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ]
            ]
        ];
    }

    /**
     * Get the configuration for this module.
     *
     * @return array Module configuration
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * Get service configuration.
     *
     * @return array Service configuration
     */
    public function getServiceConfig()
    {
        return [
            'invokables' => [
            ],
            'factories' => [
                // fake 'alias' for entity manager, because doctrine uses an abstract factory
                // and aliases don't work with abstract factories
                'activity_doctrine_em' => function ($sm) {
                    return $sm->get('doctrine.entitymanager.orm_default');
                },
                'activity_form_calendar_option' => function ($sm) {
                    $organService = $sm->get('decision_service_organ');
                    $organs = $organService->getEditableOrgans();
                    $form = new Form\ActivityCalendarOption($organs, $sm->get('translator'));
                    $form->setHydrator($sm->get('activity_hydrator_calendar_option'));
                    return $form;
                },
                'activity_hydrator_calendar_option' => function ($sm) {
                    return new \DoctrineModule\Stdlib\Hydrator\DoctrineObject(
                        $sm->get('activity_doctrine_em'),
                        'Activity\Model\ActivityCalendarOption'
                    );
                },
                'activity_hydrator' => function ($sm) {
                    return new \DoctrineModule\Stdlib\Hydrator\DoctrineObject(
                        $sm->get('activity_doctrine_em')
                    );
                },
                'activity_service_calendar' => function ($sm) {
                    $ac = new Service\ActivityCalendar();
                    $ac->setServiceManager($sm);

                    return $ac;
                },
                'activity_mapper_calendar_option' => function ($sm) {
                    return new \Activity\Mapper\ActivityCalendarOption(
                        $sm->get('activity_doctrine_em')
                    );
                },
                'activity_acl' => function ($sm) {
                    $acl = $sm->get('acl');
                    $acl->addResource('activity_option');

                    $acl->allow('user', 'activity_option', ['create', 'delete_own']);
                    return $acl;
                },
            ]
        ];
    }
}
