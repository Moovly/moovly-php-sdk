<?php

namespace Moovly\SDK\Model;

/**
 * Class Render
 * @package Moovly\SDK\Model
 */
class Render
{
    /** @var null|string */
    private $id;

    /** @var string */
    private $state;

    /** @var null|string */
    private $url = null;

    /** @var null|string */
    private $quality = null;

    /** @var string */
    private $type;

    /** @var null|string */
    private $error = null;

    /** @var null|string */
    private $projectId = null;

    /** @var \DateTimeImmutable */
    private $startedAt;

    /** @var null|\DateTimeImmutable */
    private $dateFinished;

    /**
     * Returns the Id
     *
     * @return null|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the Id
     *
     * @param null|string $id
     *
     * @return Render
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Returns the State
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Sets the State
     *
     * @param string $state
     *
     * @return Render
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Returns the Url
     *
     * @return null|string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the Url
     *
     * @param null|string $url
     *
     * @return Render
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Returns the Quality
     *
     * @return null|string
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * Sets the Quality
     *
     * @param null|string $quality
     *
     * @return Render
     */
    public function setQuality($quality)
    {
        $this->quality = $quality;

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
     * @return Render
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Returns the Error
     *
     * @return null|string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Sets the Error
     *
     * @param null|string $error
     *
     * @return Render
     */
    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * Returns the ProjectId
     *
     * @return null|string
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * Sets the ProjectId
     *
     * @param null|string $projectId
     *
     * @return Render
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;

        return $this;
    }

    /**
     * Returns the StartedAt
     *
     * @return null|\DateTimeImmutable
     */
    public function getStartedAt()
    {
        return $this->startedAt;
    }

    /**
     * Sets the StartedAt
     *
     * @param null|\DateTimeImmutable $startedAt
     *
     * @return Render
     */
    public function setStartedAt(\DateTimeImmutable $startedAt = null)
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    /**
     * Returns the DateFinished
     *
     * @return null|\DateTimeImmutable
     */
    public function getDateFinished()
    {
        return $this->dateFinished;
    }

    /**
     * Sets the DateFinished
     *
     * @param null|\DateTimeImmutable $dateFinished
     *
     * @return Render
     */
    public function setDateFinished(\DateTimeImmutable $dateFinished = null)
    {
        $this->dateFinished = $dateFinished;

        return $this;
    }
}
