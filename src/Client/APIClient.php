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
    const DOMAIN_PROJECT = 'project';

    const DOMAIN_TO_VERSION = [
        'user' => 'v1',
        'generator' => 'v1',
        'api2' => 'v1',
        'project' => 'v1',
        'render' => 'v1',
    ];

    const ENDPOINT_UPLOAD_ASSET = '/api2/{version}/objects/upload';
    const ENDPOINT_UPLOAD_VIDEO = '/api2/{version}/objects/upload/video-url';
    const ENDPOINT_PERSONAL_LIBRARY = '/api2/{version}/user/me/personal-library';
    const ENDPOINT_GET_JOBS_BY_USER = '/generator/{version}/users/{templateId}/jobs';
    const ENDPOINT_GET_JOBS_BY_TEMPLATE = '/generator/{version}/templates/{templateId}/jobs';
    const ENDPOINT_GET_CONTRACTS_BY_USER = '/generator/{version}/users/me/contracts';
    const ENDPOINT_GET_RENDERS_BY_USER = '/render/{version}/renders';

    const RESTFUL_ROOT_USER = '/user/{version}/users';
    const RESTFUL_ROOT_PROJECT = '/project/{version}/projects';
    const RESTFUL_ROOT_PROJECTS = '/project/{version}/users/me/projects';
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
    public function getUser()
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
    public function getUserPersonalLibrary()
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
     * @param string[] $expand
     *
     * @return array
     *
     * @throws ClientException
     */
    public function getProjects($filter = null, $expand = [])
    {
        $options = [
            'query' => [
                'filter' => $filter,
                'expand' => $expand
            ]
        ];

        return $this->doRestfulCall('GET', self::RESTFUL_ROOT_PROJECTS, self::DOMAIN_PROJECT, null, $options);
    }

    public function getRendersForUser($externalType)
    {
        $options = [
            'query' => [
                'external_type' => $externalType,
            ]
        ];

        return $this->doRestfulCall('GET', self::ENDPOINT_GET_RENDERS_BY_USER, self::DOMAIN_PROJECT, null, $options);

    }

    /**
     * Fetches one project.
     *
     * @param string $id
     * @param array $expand
     *
     * @return array
     *
     * @throws ClientException
     */
    public function getProject($id, $expand = [])
    {
        $options = [
            'query' => [
                'expand' => $expand
            ]
        ];
        return $this->doRestfulCall('GET', self::RESTFUL_ROOT_PROJECT, self::DOMAIN_PROJECT, $id, $options);
    }

    /**
     * Fetches all templates the bearer has access to. These include shared templates as well.
     *
     * @return array
     *
     * @throws ClientException
     */
    public function getTemplates($filters)
    {
        $options = [
            'query' => [
                'filters' => $filters
            ]
        ];
        return $this->doRestfulCall('GET', self::RESTFUL_ROOT_TEMPLATE, self::DOMAIN_GENERATOR, null, $options);
    }

    /**
     * @param string $id
     *
     * @return array
     *
     * @throws ClientException
     */
    public function getTemplate($id)
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
    public function createTemplate($projectId)
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
     * @param array  $notifications
     *
     * @return array
     * @t
     */
<<<<<<< HEAD
    public function createJob($templateId, array $jobOptions, array $values)
=======
    public function createJob(string $templateId, array $jobOptions, array $values, array $notifications): array
>>>>>>> 431bc87... add notifications to jobs
    {
        $options = [
            'json' => [
                'template_id' => $templateId,
                'options' => $jobOptions,
                'values' => $values,
                'notifications' => $notifications
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
    public function getJob($id)
    {
        return $this->doRestfulCall('GET', self::RESTFUL_ROOT_JOB, self::DOMAIN_GENERATOR, $id);
    }

    public function getUserContracts()
    {
        $endpoint = $this->stringEngine->render(
            self::ENDPOINT_GET_CONTRACTS_BY_USER,
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
     * Fetches all jobs that have been made with a certain template.
     *
     * @param string $templateId
     *
     * @return array
     *
     * @throws ClientException
     */
    public function getJobsByTemplate($templateId)
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
    public function getJobsByUser($userId)
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
    public function getObject($id)
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
        $filename = $file->getFilename();
        $object = $this->getObjectWithSignedUrl($filename, $libraryId);

        $endpoint = $object['url'];

        $this->client->put(
            $endpoint,
            ['body' => fopen($file->getPathname(), 'r')]
        );

        return $object['data'];
    }

    /**
     * @param string      $filename
     * @param string|null $libraryId
     *
     * @return array
     */
    public function getUploadUrl($filename, $libraryId)
    {
        $object = $this->getObjectWithSignedUrl($filename, $libraryId);
        return $object;
    }

    /**
     * Creates the Object entity and a signed url from S3 to upload the actual asset to.
     *
     * @param string      $filename
     * @param string|null $libraryId
     *
     * @return array
     */
    private function getObjectWithSignedUrl($filename, $libraryId)
    {
        $endpoint = $this->stringEngine->render(
            self::ENDPOINT_UPLOAD_VIDEO,
            ['version' => self::DOMAIN_TO_VERSION[self::DOMAIN_API2]]
        );

        $form = [
            'filename' => $filename,
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
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Returns the internal GuzzleHTTP client used. This in order to allow end-users to supply their own middleware
     * to the client.
     *
     * @return Client
     */
    public function getClient()
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
    private function doRestfulCall($method, $root, $domain, $id = null, array $options = [])
    {
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
