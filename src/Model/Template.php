<?php

namespace Moovly\SDK\Model;

/**
 * Class Template
 *
 * @package Moovly\SDK\Model
 */
class Template
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $originalProjectId;

    /** @var Variable[] */
    private $variables;

    /** @var string */
    private $thumbnail;

    /** @var string */
    private $preview;

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
     * @return Template
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
     * @return Template
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Returns the OriginalProjectId
     *
     * @return string
     */
    public function getOriginalProjectId()
    {
        return $this->originalProjectId;
    }

    /**
     * Sets the OriginalProjectId
     *
     * @param string $originalProjectId
     *
     * @return Template
     */
    public function setOriginalProjectId($originalProjectId)
    {
        $this->originalProjectId = $originalProjectId;

        return $this;
    }

    /**
     * Returns the Variables
     *
     * @return Variable[]
     */
    public function getVariables(): array
    {
        return $this->variables;
    }

    /**
     * Sets the Variables
     *
     * @param Variable[] $variables
     *
     * @return Template
     */
    public function setVariables(array $variables)
    {
        $this->variables = $variables;

        return $this;
    }

    /**
     * Returns the Thumbnail
     *
     * @return string
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Sets the Thumbnail
     *
     * @param string $thumbnail
     *
     * @return Template
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Returns the Preview
     *
     * @return string
     */
    public function getPreview()
    {
        return $this->preview;
    }

    /**
     * Sets the Preview
     *
     * @param string $preview
     *
     * @return Template
     */
    public function setPreview($preview)
    {
        $this->preview = $preview;

        return $this;
    }
}