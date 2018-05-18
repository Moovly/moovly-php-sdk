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

    /**
     * Returns the Id
     *
     * @return string
     */
    public function getId(): string
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
    public function setId(string $id): Template
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Returns the Name
     *
     * @return string
     */
    public function getName(): string
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
    public function setName(string $name): Template
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Returns the OriginalProjectId
     *
     * @return string
     */
    public function getOriginalProjectId(): string
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
    public function setOriginalProjectId(string $originalProjectId): Template
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
    public function setVariables(array $variables): Template
    {
        $this->variables = $variables;

        return $this;
    }
}