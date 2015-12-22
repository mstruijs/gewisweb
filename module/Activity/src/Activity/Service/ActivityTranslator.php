<?php

namespace Activity\Service;

use Application\Service\AbstractService;

class ActivityTranslator extends AbstractService
{
    /**
     * Get the translated activity for the preferred language if it is available,
     * otherwise get the other language
     *
     * @param ActivityModel $activity
     * @param type $preferredLanguage 'nl' or 'en'
     * @return type
     */
    public function getTranslatedActivity(ActivityModel $activity, $preferredLanguage)
    {
        //Get the preferred language if it is available, otherwise get the other language
        $language = ($preferredLanguage === 'nl' && !is_null($activity->getName())) ||
            ($preferredLanguage === 'en' && is_null($activity->getNameEn())) ? 'nl':'en';

        return $this->createActivityTranslation($activity, $language);
    }

    /**
     * Create an activity translation of the specified language
     *
     * @param ActivityModel $activity
     * @param type $language
     * @return \Activity\Model\ActivityTranslation
     */
    protected function createActivityTranslation(ActivityModel $activity, $language)
    {
        $activityTranslation = new \Activity\Model\ActivityTranslation();

        //Populate the common-language parts
        $activityTranslation->setId($activity->getId());
        $activityTranslation->setBeginTime($activity->getBeginTime());
        $activityTranslation->setEndTime($activity->getEndTime());
        $activityTranslation->setCanSignUp($activity->getCanSignUp());
        $activityTranslation->setOnlyGEWIS($activity->getOnlyGEWIS());
        $activityTranslation->setApprover($activity->getApprover());
        $activityTranslation->setCreator($activity->getCreator());
        $activityTranslation->setStatus($activity->getStatus());
        $activityTranslation->setSignUps($activity->getSignUps());
        //TODO: add organ when relevant.


        if ($language === 'en'){
            $activityTranslation->setName($activity->getNameEn());
            $activityTranslation->setLocation($activity->getLocationEn());
            $activityTranslation->setCosts($activity->getCostsEn());
            $activityTranslation->setDescription($activity->getDescriptionEn());
        }
        if ($language === 'nl'){
            $activityTranslation->setName($activity->getName());
            $activityTranslation->setLocation($activity->getLocation());
            $activityTranslation->setCosts($activity->getCosts());
            $activityTranslation->setDescription($activity->getDescription());
        }
        $fieldTranslations = [];
        foreach ($activity->getFields() as $field){
            $fieldTranslations += $this->createActivityFieldTranslation($field, $language);
        }
        $activityTranslation->setFields($fieldTranslations);

        return $activityTranslation;
    }

    protected function createActivityFieldTranslation(ActivityFieldModel $field, $language) {

        $fieldTranslation = new \Activity\Model\ActivityFieldTranslation();

        //Populate the common-language parts
        $fieldTranslation->setId($field->getId());
        $fieldTranslation->setActivity($field->getActivity());
        $fieldTranslation->setMinimumValue($field->getMinimumValue());
        $fieldTranslation->setMaximumValue($field->getMaximumValue());
        $fieldTranslation->setType($field->getType());

        if ($language === 'en'){
            $fieldTranslation->setName($field->getNameEn());
        }
        if ($language === 'nl'){
            $fieldTranslation->setName($field->getName());
        }
        $optionTranslations = [];
        foreach ($field->getOptions() as $option){
            $optionTranslations += $this->createActivityOptionTranslation($option, $language);
        }
        $fieldTranslation->setOptions($optionTranslations);

        return $fieldTranslation;
    }

    /**
     * Create an option translation of the specified language
     * @param ActivityOptionModel $option
     * @param string $language 'nl' or 'en'
     * @return \Activity\Model\ActivityOptionTranslation
     */
    protected function createActivityOptionTranslation(ActivityOptionModel $option, $language) {

        $optionTranslation = new \Activity\Model\ActivityOptionTranslation();

        //Populate the common-language parts
        $optionTranslation->setField($option->getField());
        $optionTranslation->setId($option->getId());

        if ($language === 'en'){
            $optionTranslation->setValue($option->getValueEn());
        }
        if ($language === 'nl'){
            $optionTranslation->setValue($option->getValue());
        }

        return $optionTranslation;
    }
}