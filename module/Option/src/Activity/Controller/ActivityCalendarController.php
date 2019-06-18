<?php

namespace Option\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ActivityCalendarController extends AbstractActionController
{

    public function indexAction()
    {
        $service = $this->getActivityCalendarService();
        $createdOption = null;
        $optionError = false;
        $request = $this->getRequest();
        if ($request->isPost()) {
            $createdOption = $service->createOption($request->getPost());
            if ($createdOption) {
                return $this->redirect()->toRoute('Option\option_calendar', [], ['query' => ['success' => 'true']]);

            }
            $optionError = true;
        }
        $config = $service->getConfig();
        return new ViewModel([
            'options' => $service->getUpcomingOptions(),
            'editableOptions' => $service->getEditableUpcomingOptions(),
            'APIKey' => $config['google_api_key'],
            'calendarKey' => $config['google_calendar_key'],
            'form' => $service->getCreateOptionForm(),
            'optionError' => $optionError,
            'createdOption' => $createdOption,
            'success' => $request->getQuery('success', false)
        ]);
    }

    public function deleteAction()
    {
        $service = $this->getActivityCalendarService();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $service->deleteOption($request->getPost());
            $this->redirect()->toRoute('Option\option_calendar');
        }
    }

    public function sendNotificationsAction()
    {
        $this->getActivityCalendarService()->sendOverdueNotifications();
    }

    /**
     * Get the activity calendar service
     *
     * @return \Option\Service\ActivityCalendar
     */
    private function getActivityCalendarService()
    {
        return $this->getServiceLocator()->get('Option\option_service_calendar');
    }
}
