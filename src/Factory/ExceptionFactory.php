<?php

namespace Moovly\SDK\Factory;

use Moovly\SDK\Exception\BadAuthorizationException;
use Moovly\SDK\Exception\BadRequestException;
use Moovly\SDK\Exception\MoovlyException;
use Moovly\SDK\Exception\NotFoundException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ExceptionFactory
 *
 * @package Moovly\SDK\Factory
 */
class ExceptionFactory
{
    /**
     * @param ResponseInterface $response
     * @param \Exception        $e
     *
     * @return MoovlyException
     */
    public static function create(ResponseInterface $response, \Exception $e)
    {
        try {
            $APIResponse = json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            $APIResponse = [];
        }

        $message = null;

        if (array_key_exists('message', $APIResponse)) {
            $message = $APIResponse['message'];
        }

        switch ($response->getStatusCode()) {
            case 400:
                return new BadRequestException($message);
            case 401:
            case 403:
                return new BadAuthorizationException();
            case 404:
                return new NotFoundException($message);
            default:
                return new MoovlyException('The API resulted in a faulty request', 400, $e);
        }
    }
}
