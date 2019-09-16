<?php

namespace Moovly\SDK\Service;

use GuzzleHttp\Exception\ClientException;
use Moovly\SDK\Client\APIClient;
use Moovly\SDK\Exception\BadAssetException;
use Moovly\SDK\Exception\BadRequestException;
use Moovly\SDK\Exception\MoovlyException;
use Moovly\SDK\Factory\ExceptionFactory;
use Moovly\SDK\Factory\JobFactory;
use Moovly\SDK\Factory\LibraryFactory;
use Moovly\SDK\Factory\ObjectFactory;
use Moovly\SDK\Factory\ProjectFactory;
use Moovly\SDK\Factory\TemplateFactory;
use Moovly\SDK\Factory\UserFactory;
use Moovly\SDK\Model\Job;
use Moovly\SDK\Model\Library;
use Moovly\SDK\Model\MoovlyObject;
use Moovly\SDK\Model\Project;
use Moovly\SDK\Model\Template;
use Moovly\SDK\Model\User;
use Moovly\SDK\Model\Value;

/**
 * The class your application should interact with.
 *
 * This class will only take objects, so if you want to e.g. create a template, you'll need to first call the
 * TemplateFactory. Every entity has it's own factory.
 *
 * Look into the Moovly\SDK\Factory namespace to see all factories.
 *
 * Class MoovlyService
 *
 * @package Moovly\SDK\Service
 */
final class MoovlyService
{
    const SUPPORTED_VIDEO_EXTENSIONS = [
        'mkv',
        'flv',
        'wmv',
        'mp4',
        'm4v',
        'mpeg',
        'avi',
        'webm',
        'mov'
    ];

    const SUPPORTED_IMAGE_EXTENSIONS = [
        'gif',
        'jpeg',
        'jpg',
        'png',
    ];

    const SUPPORTED_AUDIO_EXTENSION = [
        'flac',
        'm4a',
        'mp3',
        'wav',
        'ogg',
        'wma',
    ];

    /** @var APIClient */
    private $client;

    /**
     * MoovlyService constructor.
     *
     * @param APIClient $client
     * @param string $token
     */
    public function __construct(APIClient $client, string $token)
    {
        $this->client = $client;
        $this->client->setToken($token);
    }

    /**
     * Fetches an object from the Moovly API.
     * https://api-docs.services.moovly.com/docs/api/assets#GET-/api2/v1/objects/{id}
     *
     * @param string $id
     *
     * @return MoovlyObject
     *
     * @throws MoovlyException
     */
    public function getObject(string $id): MoovlyObject
    {
        try {
            $object = ObjectFactory::createFromAPIResponse(
                $this->client->getObject($id)
            );
        } catch (ClientException $ce) {
            $response = $ce->getResponse();

            throw ExceptionFactory::create($response, $ce);
        }

        return $object;
    }

    /**
     * Uploads an asset to the Moovly API.
     *
     * @param \SplFileInfo $file
     * @param Library      $library
     *
     * @return MoovlyObject

     * @throws MoovlyException
     */
    public function uploadAsset(\SplFileInfo $file, Library $library = null): MoovlyObject
    {
        $supportedExtensions = array_merge(
            self::SUPPORTED_AUDIO_EXTENSION,
            self::SUPPORTED_IMAGE_EXTENSIONS,
            self::SUPPORTED_VIDEO_EXTENSIONS
        );

        $assetExtensions = array_merge(
            self::SUPPORTED_AUDIO_EXTENSION,
            self::SUPPORTED_IMAGE_EXTENSIONS
        );

        if (!in_array($file->getExtension(), $supportedExtensions)) {
            throw new BadAssetException($file);
        }

        if (in_array($file->getExtension(), $assetExtensions)) {
            try {
                $object = $this->client->uploadAsset($file, is_null($library) ? null : $library->getId());
            } catch (ClientException $ce) {
                $response = $ce->getResponse();

                throw ExceptionFactory::create($response, $ce);
            }

            return ObjectFactory::createFromAPIResponse($object);
        }

        try {
            $object = $this->client->uploadAsset($file, is_null($library) ? null : $library->getId());
        } catch (ClientException $ce) {
            $response = $ce->getResponse();

            throw ExceptionFactory::create($response, $ce);
        }

        return ObjectFactory::createFromAPIResponse($object);
    }

    /**
     * Fetches one project.
     *
     * @param string $projectId
     *
     * @return Project
     *
     * @throws MoovlyException
     */
    public function getProject(string $projectId): Project
    {
        try {
            $project = ProjectFactory::createFromAPIResponse(
                $this->client->getProject($projectId)
            );
        } catch (ClientException $ce) {
            $response = $ce->getResponse();

            throw ExceptionFactory::create($response, $ce);
        }

        return $project;
    }

    /**
     * Fetches all projects.
     *
     * @param string $filter
     *
     * @return Project[]
     *
     * @throws MoovlyException
     */
    public function getProjects(?string $filter = 'unarchived'): array
    {
        if (is_null($filter)) {
            $filter = 'unarchived';
        }

        try {
            $response = $this->client->getProjects($filter);
        } catch (ClientException $ce) {
            $response = $ce->getResponse();

            throw ExceptionFactory::create($response, $ce);
        }

        $projects = array_map(function (array $project) {
            return ProjectFactory::createFromAPIResponse($project);
        }, $response);

        return $projects;
    }

    /**
     * Creates a template.
     *
     * @param Project $project
     *
     * @return Template
     *
     * @throws MoovlyException
     */
    public function createTemplate(Project $project): Template
    {
        try {
            $template = TemplateFactory::createFromAPIResponse(
                $this->client->createTemplate($project->getId())
            );
        } catch (ClientException $ce) {
            $response = $ce->getResponse();

            throw ExceptionFactory::create($response, $ce);
        }

        return $template;
    }

    /**
     * Fetches a template.
     *
     * @param string $templateId
     *
     * @return Template
     *
     * @throws MoovlyException
     */
    public function getTemplate(string $templateId): Template
    {
        try {
            $template = TemplateFactory::createFromAPIResponse($this->client->getTemplate($templateId));
        } catch (ClientException $ce) {
            $response = $ce->getResponse();

            throw ExceptionFactory::create($response, $ce);
        }

        return $template;
    }

    /**
     * Fetches all templates the bearer has access to.
     *
     * @return Template[]
     *
     * @throws MoovlyException
     */
    public function getTemplates(): array
    {
        try {
            $response = $this->client->getTemplates();
        } catch (ClientException $ce) {
            $response = $ce->getResponse();

            throw ExceptionFactory::create($response, $ce);
        }

        $templates = array_map(function (array $template) {
            return TemplateFactory::createFromAPIResponse($template);
        }, $response);

        return $templates;
    }

    /**
     * Registers a new Job request in the Moovly API. This expects a Job model. Use the
     * JobFactory and the ValueFactory to create this.
     *
     * @param Job   $job
     *
     * @return Job
     *
     * @throws MoovlyException
     */
    public function createJob(Job $job): Job
    {
        $validQualities = ['480p', '720p', '1080p'];

        $options = array_merge([
            'quality'     => '480p',
            'create_moov' => false,
            'auto_render' => true,
        ], $job->getOptions());

        if (!in_array($options['quality'], $validQualities)) {
            throw new BadRequestException(
                sprintf(
                    'The given quality (%s) for a job is invalid, please use a valid one (%s).',
                    $options['quality'],
                    implode(', ', $validQualities)
                )
            );
        }

        if (!is_null($job->getId())) {
            throw new BadRequestException(
                'The given job already has an id. This either means you set this manually, or this is a job already ' .
                    ' registered in Moovly. In the first case, stop assigning a job id, in the latter case, just ' .
                    ' read the job.'
            );
        }

        if (is_null($job->getTemplate())) {
            throw new BadRequestException(
                'You have not supplied a template in the job request. Please run $job->setTemplate() before calling' .
                    ' $service->createJob().'
            );
        }

        $values = array_map(function (Value $value) {
            return [
                'external_id' => $value->getExternalId(),
                'title'       => $value->getTitle(),
                'template_variables' => $value->getTemplateVariables()
            ];
        }, $job->getValues());

        try {
            $result = JobFactory::createFromAPIResponse(
                $this->client->createJob($job->getTemplate()->getId(), $options, $values)
            );

            $result
                ->setTemplate($job->getTemplate())
                ->setOptions($job->getOptions())
                ->setValues($this->mergeJobValues($job->getValues(), $result->getValues()))
            ;
        } catch (ClientException $ce) {
            $response = $ce->getResponse();

            throw ExceptionFactory::create($response, $ce);
        }

        return $result;
    }

    /**
     * Gets a job.
     *
     * @param string $jobId
     *
     * @return Job
     *
     * @throws MoovlyException
     */
    public function getJob(string $jobId): Job
    {
        try {
            $job = JobFactory::createFromAPIResponse($this->client->getJob($jobId));
        } catch (ClientException $ce) {
            $response = $ce->getResponse();

            throw ExceptionFactory::create($response, $ce);
        }

        return $job;
    }

    /**
     * Gets all the jobs that were made with a template.
     *
     * @param Template $template
     *
     * @return Job[]
     *
     * @throws MoovlyException
     */
    public function getJobsByTemplate(Template $template): array
    {
        try {
            $response = $this->client->getJobsByTemplate($template->getId());
        } catch (ClientException $ce) {
            $response = $ce->getResponse();

            throw ExceptionFactory::create($response, $ce);
        }

        $jobs = array_map(function (array $job) {
            return JobFactory::createFromAPIResponse($job);
        }, $response);

        return $jobs;
    }

    /**
     * Gets all jobs for a user. To get the current user, call $service->getCurrentUser().
     *
     * @param User $user
     *
     * @return Job[]
     *
     * @throws MoovlyException
     */
    public function getJobsByUser(User $user): array
    {
        try {
            $response = $this->client->getJobsByUser($user->getId());
        } catch (ClientException $ce) {
            $response = $ce->getResponse();

            throw ExceptionFactory::create($response, $ce);
        }

        $jobs = array_map(function (array $job) {
            return JobFactory::createFromAPIResponse($job);
        }, $response);

        return $jobs;
    }

    /**
     * Returns the current user.
     *
     * @return User
     *
     * @throws MoovlyException
     */
    public function getCurrentUser(): User
    {
        try {
            $user = UserFactory::createFromAPIResponse($this->client->getUser());
        } catch (ClientException $ce) {
            $response = $ce->getResponse();

            throw ExceptionFactory::create($response, $ce);
        }

        return $user;
    }

    /**
     * Get the user's personal library.
     *
     * @return Library
     *
     * @throws MoovlyException
     */
    public function getPersonalLibraryForUser(): Library
    {
        try {
            $library = LibraryFactory::createFromAPIResponse($this->client->getUserPersonalLibrary());
        } catch (ClientException $ce) {
            $response = $ce->getResponse();

            throw ExceptionFactory::create($response, $ce);
        }

        return $library;
    }

    /**
     * Makes sure the API of newly created jobs is as complete for values as possible.
     *
     * @param array $preRequestValues
     * @param array $postRequestValues
     *
     * @return array
     */
    private function mergeJobValues(array $preRequestValues, array $postRequestValues)
    {
        $result = array_map(function (Value $postValue) use ($preRequestValues) {
            $preValues = array_filter($preRequestValues, function (Value $preValue) use ($postValue) {
                return $postValue->getExternalId() === $preValue->getExternalId();
            });

            /** @var Value $preValue */
            $preValue = $preValues[0];

            $postValue
                ->setTemplateVariables($preValue->getTemplateVariables())
                ->setTitle($preValue->getTitle())
            ;

            return $postValue;
        }, $postRequestValues);

        return $result;
    }
}
