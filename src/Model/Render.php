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
    public function getId() : ?string
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
    public function setId(?string $id) : Render
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Returns the State
     *
     * @return string
     */
    public function getState() : string
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
    public function setState(string $state) : Render
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Returns the Url
     *
     * @return null|string
     */
    public function getUrl() : ?string
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
    public function setUrl(?string $url) : Render
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Returns the Quality
     *
     * @return null|string
     */
    public function getQuality() : ?string
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
    public function setQuality(?string $quality) : Render
    {
        $this->quality = $quality;

        return $this;
    }

    /**
     * Returns the Type
     *
     * @return string
     */
    public function getType() : string
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
    public function setType(string $type) : Render
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Returns the Error
     *
     * @return null|string
     */
    public function getError() : ?string
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
    public function setError(?string $error) : Render
    {
        $this->error = $error;

        return $this;
    }

    /**
     * Returns the ProjectId
     *
     * @return null|string
     */
    public function getProjectId() : ?string
    {
        return $this->project_id;
    }

    /**
     * Sets the ProjectId
     *
     * @param null|string $projectId
     *
     * @return Render
     */
    public function setProjectId(?string $projectId) : Render
    {
        $this->project_id = $projectId;

        return $this;
    }

    /**
     * Returns the StartedAt
     *
     * @return null|\DateTimeImmutable
     */
    public function getStartedAt(): \DateTimeImmutable
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
    public function setStartedAt(?\DateTimeImmutable $startedAt): Render
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    /**
     * Returns the DateFinished
     *
     * @return null|\DateTimeImmutable
     */
    public function getDateFinished(): \DateTimeImmutable
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
    public function setDateFinished(?\DateTimeImmutable $dateFinished): Render
    {
        $this->dateFinished = $dateFinished;

        return $this;
    }
}