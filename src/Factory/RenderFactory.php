<?php

namespace Moovly\SDK\Factory;

use Moovly\SDK\Model\Render;

/**
 * Class RenderFactory
 * @package Moovly\SDK\Factory
 */
class RenderFactory
{
    /**
     * @param array  $renders
     *
     * @return Render[]
     */
    public static function createFromAPIResponse(array $renders) : array
    {
        $results = [];

        foreach ($renders as $render) {
            $results[] = (new Render())
                ->setId($render['id'])
                ->setState($render['state'])
                ->setStartedAt(new \DateTimeImmutable($render['started_at']))
                ->setDateFinished(new \DateTimeImmutable($render['date_finished']))
                ->setUrl($render['url'])
                ->setError($render['error'])
                ->setQuality($render['quality'])
                ->setType($render['type'])
                ->setProjectId($render['project_id']);
        }

        return $results;
    }
}
