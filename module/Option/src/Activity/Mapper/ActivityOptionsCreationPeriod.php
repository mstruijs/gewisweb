<?php

namespace Option\Mapper;

use Option\Model\ActivityOptionsCreationPeriod as ActivityOptionsCreationPeriodModel;
use DateTime;
use Decision\Model\Organ;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Exception;

class ActivityOptionsCreationPeriod
{
    /**
     * Doctrine entity manager.
     *
     * @var EntityManager
     */
    protected $em;

    /**
     * Constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Finds the ActivityOptionsCreationPeriod model with the given id.
     *
     * @param int $id
     * @return ActivityOptionsCreationPeriodModel
     */
    public function getActivityOptionsCreationPeriodById($id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * Finds the ActivityOptionsCreationPeriod model that is currently active
     *
     * @return ActivityOptionsCreationPeriod
     * @throws Exception
     */
    public function getCurrentActivityOptionsCreationPeriod()
    {
        $qb = $this->em->createQueryBuilder();

        $today = new DateTime();

        $qb->select('x')
            ->from('Option\Model\ActivityOptionsCreationPeriod', 'x')
            ->where('x.beginTime < :today')
            ->where('x.endTime > :today')
            ->orderBy('x.beginTime', 'ASC')
            ->setParameter('today', $today)
            ->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * Finds the ActivityOptionsCreationPeriod model that will be active next
     *
     * @return ActivityOptionsCreationPeriod
     * @throws Exception
     */
    public function getUpcomingActivityOptionsCreationPeriod()
    {
        $qb = $this->em->createQueryBuilder();

        $today = new DateTime();

        $qb->select('x')
            ->from('Option\Model\ActivityOptionsCreationPeriod', 'x')
            ->where('x.beginTime > :today')
            ->orderBy('x.beginTime', 'ASC')
            ->setParameter('today', $today)
            ->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult();
    }
    
    
    /**
     * Get the repository for this mapper.
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository('Option\Model\MaxActivityOptions');
    }
}