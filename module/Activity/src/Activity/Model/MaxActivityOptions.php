<?php

namespace Activity\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Max Activity options model.
 * Contains the max amount of activities an organ may create options for
 *
 * @ORM\Entity
 */
class MaxActivityOptions
{
    /**
     * ID for the field.
     *
     * @ORM\Id
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * Who created this activity.
     *
     * @ORM\OneToOne(targetEntity="Decision\Model\Organ")
     * @ORM\JoinColumn(referencedColumnName="id",nullable=false)
     */
    protected $organ;

    /**
     * The value of the option.
     *
     * @ORM\Column(type="int", nullable=false)
     */
    protected $value;

    /**
     * Set the value
     *
     * @param int $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Set the organ
     *
     * @param \Decision\Model\Organ $organ
     */
    public function setOrgan($organ)
    {
        $this->organ = $organ;
    }


    public function getId()
    {
        return $this->id;
    }


    public function getOrgan()
    {
        return $this->organ;
    }

    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns an associative array representation of this object.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'organ' => $this->getOrgan(),
            'value' => $this->getValue()
        ];
    }
}
