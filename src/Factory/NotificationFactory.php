<?php

namespace Moovly\SDK\Factory;

use Moovly\SDK\Model\Notification;
use Moovly\SDK\Model\Value;

/**
 * Class NotificationFactory
 * @package Moovly\SDK\Factory
 */
class NotificationFactory
{
    /**
     * @param string $type
     * @param array  $payload
     *
     * @return Notification
     */
    public static function create(
        $type,
        $payload = []
    ) {
        return (new Notification())
            ->setType($type)
            ->setPayload($payload)
        ;
    }
}
