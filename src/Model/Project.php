<?php

namespace Moovly\SDK\Model;

/**
 * Class Project
 * @package Moovly\SDK\Model
 */
class Project
{
    /** @var string */
    private $id;

    /** @var string */
    private $label;

    /** @var string */
    private $description;

    /** @var string */
    private $thumbnailPath;

    /** @var Render[] */
    private $renders;

    /** @var float */
    private $duration;

    /** @var bool */
    private $archived;

    /** @var bool */
    private $pending;

    /** @var \DateTimeImmutable */
    private $createdAt;

    /** @var \DateTimeImmutable */
    private $updatedAt;

    /** @var string */
    private $createdBy;

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
     * @return Project
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Returns the Label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Sets the Label
     *
     * @param string $label
     *
     * @return Project
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Returns the Description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the Description
     *
     * @param string $description
     *
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Returns the ThumbnailPath
     *
     * @return string
     */
    public function getThumbnailPath()
    {
        return $this->thumbnailPath;
    }

    /**
     * Sets the ThumbnailPath
     *
     * @param string $thumbnailPath
     *
     * @return Project
     */
    public function setThumbnailPath($thumbnailPath)
    {
        $this->thumbnailPath = $thumbnailPath;

        return $this;
    }

    /**
     * Returns the Renders
     *
     * @return Render[]
     */
    public function getRenders()
    {
        return $this->renders;
    }

    /**
     * Sets the Renders
     *
     * @param Render[] $renders
     *
     * @return Project
     */
    public function setRenders(array $renders)
    {
        $this->renders = $renders;

        return $this;
    }

    /**
     * Returns the Duration
     *
     * @return float
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Sets the Duration
     *
     * @param float $duration
     *
     * @return Project
     */
    public function setDuration($duration)
    {
        $this->duration = (float) $duration;

        return $this;
    }

    /**
     * Returns the Archived
     *
     * @return bool
     */
    public function isArchived()
    {
        return $this->archived;
    }

    /**
     * Sets the Archived
     *
     * @param bool $archived
     *
     * @return Project
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;

        return $this;
    }

    /**
     * Returns the Pending.
     *
     * When a project is flagged as pending, you cannot do any operations towards it.
     *
     * @return bool
     */
    public function isPending()
    {
        return $this->pending;
    }

    /**
     * Sets the Pending
     *
     * @param bool $pending
     *
     * @return Project
     */
    public function setPending($pending)
    {
        $this->pending = $pending;

        return $this;
    }

    /**
     * Returns the CreatedAt
     *
     * @return \DateTimeImmutable
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Sets the CreatedAt
     *
     * @param \DateTimeImmutable $createdAt
     *
     * @return Project
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Returns the UpdatedAt
     *
     * @return \DateTimeImmutable
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Sets the UpdatedAt
     *
     * @param \DateTimeImmutable $updatedAt
     *
     * @return Project
     */
    public function setUpdatedAt(\DateTimeImmutable $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Returns the CreatedBy
     *
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Sets the CreatedBy
     *
     * @param string $createdBy
     *
     * @return Project
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
