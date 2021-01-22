<?php

namespace Moovly\SDK\Model;

/**
 * Class Job
 * @package Moovly\SDK\Model
 */
class Job
{
    /** @var string */
    private $id;

    /** @var array */
    private $options = [];

    /** @var Template */
    private $template;

    /** @var Value[] */
    private $values;

    /** @var Notification[] */
    private $notifications = [];

    /** @var string */
    private $status = 'unsent';

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
     * @return Job
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Returns the Options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets the Options
     *
     * @param array $options
     *
     * @return Job
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Returns the Template. The template will only return a value when set by the end-user. This is only
     * used for creating jobs.
     *
     * @return Template
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Sets the Template
     *
     * @param Template $template
     *
     * @return Job
     */
    public function setTemplate(Template $template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Returns the Values
     *
     * @return Value[]
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Sets the Values
     *
     * @param Value[] $values
     *
     * @return Job
     */
    public function setValues(array $values)
    {
        $this->values = $values;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuality()
    {
        return $this->options['quality'];
    }

    /**
     * @return bool
     */
    public function createsMoov()
    {
        return $this->options['create_moov'];
    }

    /**
     * @return bool
     */
    public function autoRenders()
    {
        return $this->options['auto_render'];
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
     * @return Job
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Notification[]
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * @param Notification[] $notifications
     *
     * @return Job
     */
    public function setNotifications(array $notifications)
    {
        $this->notifications = $notifications;

        return $this;
    }
}
