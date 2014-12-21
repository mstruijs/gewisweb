<?php

namespace Photo\Mapper;

use Photo\Model\Album as AlbumModel;
use Doctrine\ORM\EntityManager;

/**
 * Mappers for Album.
 * 
 */
class Album
{

    /**
     * Doctrine entity manager.
     *
     * @var EntityManager
     */
    protected $em;

    /**
     * Constructor
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    /**
     * retrieves an album by id from the database
     * 
     * @param integer $id the id of the album
     * 
     * @return Photo\Model\Album
     */
    public function getAlbumById($id)
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('a')
                ->from('Photo\Model\Album', 'a')
                ->where('a.id = ?1');
        $qb->setParameter(1, $id);
        $res = $qb->getQuery()->getResult();
        return empty($res) ? null : $res[0];
    }
    /**
     * returns all the subalbums.
     * 
     * @return array of AlbumModels
     */
    public function getSubAlbums($parent_id)
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('a')
                ->from('Photo\Model\Album', 'a')
                ->where('a.parent = ?1');
        $qb->setParameter(1, $parent_id);

        return $qb->getQuery()->getResult();
    }

    /**
     * return all the subalbums without a parent
     * 
     * @return array of AlbumModels
     */
    public function getRootAlbums()
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('a')
                ->from('Photo\Model\Album', 'a')
                ->where('a.parent IS NULL');

        return $qb->getQuery()->getResult();
    }

    /**
     * Persist album
     *
     * @param AlbumModel $album
     */
    public function persist(AlbumModel $album)
    {
        $this->em->persist($album);
    }

    /**
     * Flush.
     */
    public function flush()
    {
        $this->em->flush();
    }

    /**
     * Get the repository for this mapper.
     *
     * @return Doctrine\ORM\EntityRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository('Photo\Mapper\Album');
    }

}