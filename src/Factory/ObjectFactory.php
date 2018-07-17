<?php

namespace Moovly\SDK\Factory;

use Moovly\SDK\Model\Asset;
use Moovly\SDK\Model\MoovlyObject;

/**
 * Class ObjectFactory
 * @package Moovly\SDK\Factory
 */
class ObjectFactory
{
    /**
     * Creates a model from the API response from /objects/{id}. Don't use this method as an end-user.
     *
     * @param array $response
     *
     * @return MoovlyObject
     */
    public static function createFromAPIResponse(array $response)
    {
        $object = new MoovlyObject();

        $assets = AssetFactory::createFromAPIResponse($response['type'], $response['assets']);

        $object
            ->setId(!key_exists('id', $response) ? $response['metadata']['id'] : $response['id'])
            ->setAssets($assets)
            ->setType($response['type'])
            ->setLabel($response['metadata']['label'])
            ->setDescription($response['metadata']['description'])
            ->setThumbnailPath(!key_exists('thumb', $response['metadata']) ? '' : $response['metadata']['thumb'])
            ->setTags(!key_exists('tags', $response['metadata']) ? [] : $response['metadata']['tags'])
            ->setAlpha(!key_exists('alpha', $response['metadata']) ? false : $response['metadata']['alpha'])
            ->setStatus($response['status'])
        ;

        return $object;
    }
}
