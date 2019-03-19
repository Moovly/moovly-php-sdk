<?php

namespace Moovly\SDK\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Moovly\SDK\Exception\BadRequestException;
use StringTemplate\Engine;

/**
 * Class APIClient
 *
 * The API Client that executes the actual HTTP calls.
 * This class should not be instantiated by third-parties.
 *
 * All API calls used here are documented at https://developer.moovly.com/api
 *
 * All API responses are JSON and are transformed to an associative array. These arrays should
 * then be processed by the MoovlyService, which will work with our models.
 *
 * @package Moovly\SDK\Client
 */
class APIClient
{
    const GATEWAY_URI = 'https://api.moovly.com';

    const DOMAIN_USER = 'user';
    const DOMAIN_GENERATOR = 'generator';
    const DOMAIN_API2 = 'api2';

    const DOMAIN_TO_VERSION = [
        'user' => 'v1',
        'generator' => 'v1',
        'api2' => 'v1',
    ];

    const ENDPOINT_UPLOAD_ASSET = '/api2/{version}/objects/upload';
    const ENDPOINT_UPLOAD_VIDEO = '/api2/{version}/objects/upload/video-url';
    const ENDPOINT_PERSONAL_LIBRARY = '/api2/{version}/user/me/personal-library';
    const ENDPOINT_GET_JOBS_BY_USER = '/generator/{version}/users/{templateId}/jobs';
    const ENDPOINT_GET_JOBS_BY_TEMPLATE = '/generator/{version}/templates/{templateId}/jobs';

    const RESTFUL_ROOT_USER = '/user/{version}/users';
    const RESTFUL_ROOT_PROJECT = '/project/{version}/projects';
    const RESTFUL_ROOT_OBJECT = '/api2/{version}/objects';
    const RESTFUL_ROOT_TEMPLATE = '/generator/{version}/templates';
    const RESTFUL_ROOT_JOB = '/generator/{version}/jobs';

    /** @var Engine  */
    private $stringEngine;

    /** @var Client  */
    private $client;

    /** @var string */
    private $token;

    /**
     * MoovlyClient constructor.
     */
    public function __construct()
    {
        $this->stringEngine = new Engine();
        $this->client = new Client(['base_uri' => self::GATEWAY_URI]);
    }

    /**
     * Fetches user information for a given bearer token.
     *
     * @return array
     *
     * @throws ClientException
     */
    public function getUser(): array
    {
        return $this->doRestfulCall('GET', self::RESTFUL_ROOT_USER, self::DOMAIN_USER);
    }

    /**
     * Gets the user's personal library object. If the personal library does not exist yet, it will be
     * created.
     *
     * @return array
     *
     * @throws ClientException
     */
    public function getUserPersonalLibrary(): array
    {
        $endpoint = $this->stringEngine->render(
            self::ENDPOINT_PERSONAL_LIBRARY,
            ['version' => self::DOMAIN_TO_VERSION[self::DOMAIN_GENERATOR]]
        );

        $response = $this->client->get($endpoint, [
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $this->token)
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Fetches all projects the bearer has access to.
     *
     * @param null|string $filter
     *
     * @return array
     *
     * @throws ClientException
     */
    public function getProjects(?string $filter = null): array
    {
        $options = [
            'query' => ['filter' => $filter]
        ];

        return $this->doRestfulCall('GET', self::RESTFUL_ROOT_PROJECT, self::DOMAIN_API2, null, $options);
    }

    /**
     * Fetches one project.
     *
     * @param string $id
     *
     * @return array
     *
     * @throws ClientException
     */
    public function getProject(string $id): array
    {
        return $this->doRestfulCall('GET', self::RESTFUL_ROOT_PROJECT, self::DOMAIN_API2, $id);
    }

    /**
     * Fetches all templates the bearer has access to. These include shared templates as well.
     *
     * @return array
     *
     * @throws ClientException
     */
    public function getTemplates(): array
    {
        return $this->doRestfulCall('GET', self::RESTFUL_ROOT_TEMPLATE, self::DOMAIN_GENERATOR);
    }

    /**
     * @param string $id
     *
     * @return array
     *
     * @throws ClientException
     */
    public function getTemplate(string $id): array
    {
        return $this->doRestfulCall('GET', self::RESTFUL_ROOT_TEMPLATE, self::DOMAIN_GENERATOR, $id);
    }

    /**
     * Creates a template from an existing project. This project needs to have some template
     * variables in order to be created, otherwise a 400 will be thrown.
     *
     * @param string $projectId
     *
     * @return array
     *
     * @throws ClientException
     */
    public function createTemplate(string $projectId): array
    {
        $options = [
            'form_params' => [
                'moov_id' => $projectId,
            ]
        ];

        return $this->doRestfulCall('POST', self::RESTFUL_ROOT_TEMPLATE, self::DOMAIN_GENERATOR, null, $options);
    }

    /**
     * Creates a job.
     *
     * @param string $templateId
     * @param array  $jobOptions
     * @param array  $values
     *
     * @return array
     *
     * @t
     */
    public function createJob(string $templateId, array $jobOptions, array $values): array
    {
        $options = [
            'json' => [
                'template_id' => $templateId,
                'options' => $jobOptions,
                'values' => $values,
            ]
        ];

        return $this->doRestfulCall('POST', self::RESTFUL_ROOT_JOB, self::DOMAIN_GENERATOR, null, $options);
    }

    /**
     * Fetches a job.
     *
     * @param string $id
     *
     * @return array
     *
     * @throws ClientException
     */
    public function getJob(string $id): array
    {
        return $this->doRestfulCall('GET', self::RESTFUL_ROOT_JOB, self::DOMAIN_GENERATOR, $id);
    }

    /**
     * Fetches all jobs that have been made with a certain template.
     *
     * @param string $templateId
     *
     * @return array
     *
     * @throws ClientException
     */
    public function getJobsByTemplate(string $templateId): array
    {
        $endpoint = $this->stringEngine->render(
            self::ENDPOINT_GET_JOBS_BY_TEMPLATE,
            ['version' => self::DOMAIN_TO_VERSION[self::DOMAIN_GENERATOR], 'templateId' => $templateId]
        );

        $response = $this->client->get($endpoint, [
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $this->token)
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Gets all jobs the bearer has started.
     *
     * @param string $userId
     *
     * @return array
     *
     * @throws ClientException
     */
    public function getJobsByUser(string $userId): array
    {
        $endpoint = $this->stringEngine->render(
            self::ENDPOINT_GET_JOBS_BY_USER,
            ['version' => self::DOMAIN_TO_VERSION[self::DOMAIN_GENERATOR], 'userId' => $userId]
        );

        $response = $this->client->get($endpoint, [
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $this->token)
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Fetches an object.
     *
     * @param string $id
     *
     * @return array
     *
     * @throws ClientException
     */
    public function getObject(string $id): array
    {
        return $this->doRestfulCall('GET', self::RESTFUL_ROOT_OBJECT, self::DOMAIN_API2, $id);
    }

    /**
     * Uploads an asset. Keep in mind that when you upload an asset, you might not want to do this
     * synchronously with the HTTP call, depending to your web server timeout settings and the size of the file.
     *
     * We suggest using a FaaS platform or creating a Docker image and queue it through AWS Batch.
     *
     * @param \SplFileInfo $file
     * @param string|null  $libraryId
     *
     * @return array
     *
     * @throws ClientException
     */
    public function uploadAsset(\SplFileInfo $file, $libraryId)
    {
        $object = $this->getObjectWithSignedUrl($file, $libraryId);

        $endpoint = $object['url'];

        $this->client->put(
            $endpoint,
            ['body' => fopen($file->getPathname(), 'r')]
        );

        return $object['data'];
    }

    /**
     * Creates the Object entity and a signed url from S3 to upload the actual asset to.
     *
     * @param \SplFileInfo $file
     * @param string|null  $libraryId
     *
     * @return array
     *
     * @throws ClientException
     */
    private function getObjectWithSignedUrl(\SplFileInfo $file, ?string $libraryId): array
    {
        $endpoint = $this->stringEngine->render(
            self::ENDPOINT_UPLOAD_VIDEO,
            ['version' => self::DOMAIN_TO_VERSION[self::DOMAIN_API2]]
        );

        $form = [
            'filename' => $file->getFilename(),
        ];

        if (!is_null($libraryId)) {
            $form['library_id'] = $libraryId;
        }

        $response = $this->client->post($endpoint, [
            'form_params' => $form,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Allows you to set the bearer token with which the API calls will be authenticated.
     *
     * More information about our Authentication can be found at https://developer.moovly.com/docs/authentication.
     *
     * @param string|null $token
     *
     * @return void
     */
    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    /**
     * Returns the internal GuzzleHTTP client used. This in order to allow end-users to supply their own middleware
     * to the client.
     *
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * Executes API calls that adhere to the RESTful standard.
     *
     * @param string $method
     * @param string $root
     * @param string $domain
     * @param null|string $id
     * @param array|null $options
     *
     * @return array
     */
    private function doRestfulCall(
        string $method,
        string $root,
        string $domain,
        ?string $id = null,
        ?array $options = []
    ): array {
        $endpoint = $this->stringEngine->render($root, ['version' => self::DOMAIN_TO_VERSION[$domain]]);

        if (!is_null($id)) {
            $endpoint .= '/' . $id;
        }

        $options = array_merge_recursive($options, [
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $this->token)
            ]
        ]);

        $response = $this->client->request($method, $endpoint, $options);

        return json_decode($response->getBody()->getContents(), true);
    }
}
