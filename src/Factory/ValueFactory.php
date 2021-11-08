<?php

namespace Moovly\SDK\Factory;

use Moovly\SDK\Model\Value;

/**
 * Class ValueFactory
 * @package Moovly\SDK\Factory
 */
class ValueFactory
{
    /**
     * @param string $externalId
     * @param string $title
     * @param array  $templateVariables
     * @param array  $notifications
     *
     * @return Value
     */
    public static function create(
        string $externalId,
        string $title,
        array $templateVariables,
        array $notifications = []
    ): Value {
        return (new Value())
            ->setTitle($title)
            ->setExternalId($externalId)
            ->setTemplateVariables($templateVariables)
            ->setNotifications($notifications)
        ;
    }

    /**
     * @param array $response
     *
     * @return Value
     */
    public static function createFromAPIResponse(array $response)
    {
        return (new Value())
            ->setExternalId($response['external_id'])
            ->setStatus($response['status'])
            ->setUrl($response['url'])
            ->setError($response['error'])
        ;
    }
}
