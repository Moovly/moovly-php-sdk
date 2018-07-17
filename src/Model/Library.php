<?php

namespace Moovly\SDK\Model;

/**
 * Class Library
 * @package Moovly\SDK\Model
 */
class Library
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

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
     * @return Library
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
     * @return Library
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
