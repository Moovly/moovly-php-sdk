<?php

namespace Moovly\SDK\Model;

/**
 * Class Variable
 *
 * @package Moovly\SDK\Model
 */
class Variable
{
    const TYPE_TEXT = 'text';
    const TYPE_IMAGE = 'image';
    const TYPE_VIDEO = 'video';

    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var int */
    private $weight;

    /** @var string */
    private $type;

    /** @var array[] */
    private $requirements;

    /**
     * Returns the Id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the Id
     *
     * @param string $id
     *
     * @return Variable
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Returns the Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the Name
     *
     * @param string $name
     *
     * @return Variable
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Returns the Weight
     *
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Sets the Weight
     *
     * @param int $weight
     *
     * @return Variable
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Returns the Type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the Type
     *
     * @param string $type
     *
     * @return Variable
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Returns the Requirements
     *
     * @return array[]
     */
    public function getRequirements()
    {
        return $this->requirements;
    }

    /**
     * Sets the Requirements
     *
     * @param array[] $requirements
     *
     * @return Variable
     */
    public function setRequirements(array $requirements)
    {
        $this->requirements = $requirements;

        return $this;
    }
}