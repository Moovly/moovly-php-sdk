<?php

namespace Moovly\SDK\Model;

/**
 * Class Value
 * @package Moovly\SDK\Model
 */
class Notification
{
    /** @var string */
    private $type;

    /** @var array */
    private $payload = [];

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Notification
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return array
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param array $payload
     *
     * @return Notification
     */
    public function setPayload(array $payload)
    {
        $this->payload = $payload;

        return $this;
    }
}
