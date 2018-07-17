<?php

namespace Moovly\SDK\Factory;

use Moovly\SDK\Model\Project;

/**
 * Class ProjectFactory
 * @package Moovly\SDK\Factory
 */
class ProjectFactory
{
    /**
     * @param array $response
     *
     * @return Project
     */
    public static function createFromAPIResponse(array $response)
    {
        $project = new Project();

        $renders = RenderFactory::createFromAPIResponse($response['renders']);

        $project
            ->setId($response['id'])
            ->setLabel($response['label'])
            ->setDescription($response['description'])
            ->setThumbnailPath($response['thumb'])
            ->setRenders($renders)
            ->setArchived($response['archived'])
            ->setPending($response['pending'])
            ->setCreatedAt(new \DateTimeImmutable($response['created_at']))
            ->setUpdatedAt(new \DateTimeImmutable($response['updated_at']))
            ->setCreatedBy((string) $response['created_by'])
        ;

        return $project;
    }
}
