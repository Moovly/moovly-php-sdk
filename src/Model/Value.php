<?php

namespace Moovly\SDK\Model;

/**
 * Class Value
 * @package Moovly\SDK\Model
 */
class Value
{
    /** @var string */
    private $externalId;

    /** @var string */
    private $title;

    /** @var array */
    private $templateVariables;

    /** @var string  */
    private $status = 'unsent';

    /** @var null|string */
    private $url = null;

    /** @var null|string */
    private $error = null;

    /**
     * Returns the ExternalId. The external id is an user-given id so they can track the value (read video render)
     * throughout their system.
     *
     * @return string
     */
    public function getExternalId()
    {
        return $this->externalId;
    }

    /**
     * Sets the ExternalId
     *
     * @param string $externalId
     *
     * @return Value
     */
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;

        return $this;
    }

    /**
     * Returns the Title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the Title
     *
     * @param string $title
     *
     * @return Value
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Returns the TemplateVariables
     *
     * @return array
     */
    public function getTemplateVariables()
    {
        return $this->templateVariables;
    }

    /**
     * Sets the TemplateVariables
     *
     * @param array $templateVariables
     *
     * @return Value
     */
    public function setTemplateVariables(array $templateVariables)
    {
        $this->templateVariables = $templateVariables;

        return $this;
    }

    /**
     * Can return an object id or text, depending on the type.
     *
     * @param Variable $variable
     *
     * @return string
     */
    public function getValueForVariable(Variable $variable)
    {
        return $this->templateVariables[$variable->getId()];
    }

    /**
     * Returns the Status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the Status
     *
     * @param string $status
     *
     * @return Value
     */
    public function setStatus($status)
    {
        $this->status = $status;

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
     * @return Value
     */
    public function setUrl($url)
    {
        $this->url = $url;

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
     * @return Value
     */
    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }
}
