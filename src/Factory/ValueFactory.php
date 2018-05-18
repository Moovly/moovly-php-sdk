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
     * @param array $templateVariables
     *
     * @return Value
     */
    public static function create(string $externalId, string $title, array $templateVariables): Value
    {
        return (new Value())
            ->setTitle($title)
            ->setExternalId($externalId)
            ->setTemplateVariables($templateVariables)
        ;
    }

    /**
     * @param array $response
     *
     * @return Value
     */
    public static function createFromAPIResponse(array $response): Value
    {
        return (new Value())
            ->setExternalId($response['external_id'])
            ->setStatus($response['status'])
            ->setUrl($response['url'])
            ->setError($response['error'])
        ;
    }
}
