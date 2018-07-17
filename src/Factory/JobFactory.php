<?php

namespace Moovly\SDK\Factory;

use Moovly\SDK\Model\Job;
use Moovly\SDK\Model\Value;

/**
 * Class JobFactory
 * @package Moovly\SDK\Factory
 */
class JobFactory
{
    /**
     * @param Value[] $values
     *
     * @return Job
     */
    public static function create(array $values)
    {
        return (new Job())->setValues($values);
    }

    /**
     * @param array $response
     *
     * @return Job
     */
    public static function createFromAPIResponse(array $response)
    {
        $job = new Job();

        $values = array_map(function (array $value) {
            return ValueFactory::createFromAPIResponse($value);
        }, $response['videos']);

        $job
            ->setId($response['id'])
            ->setStatus($response['status'])
            ->setValues($values)
        ;

        return $job;
    }
}
