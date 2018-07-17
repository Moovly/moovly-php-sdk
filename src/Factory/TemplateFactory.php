<?php

namespace Moovly\SDK\Factory;

use Moovly\SDK\Model\Template;
use Moovly\SDK\Model\Variable;

/**
 * Class TemplateFactory
 * @package Moovly\SDK\Factory
 */
class TemplateFactory
{
    public static function createFromAPIResponse(array $response)
    {
        $template = new Template();

        $variables = array_map(function (array $variable) {
            return (new Variable())
                ->setId($variable['id'])
                ->setName($variable['name'])
                ->setType($variable['type'])
                ->setRequirements($variable['requirements'])
                ->setWeight((int) $variable['weight']);
        }, $response['variables']);

        uasort($variables, function (Variable $current, Variable $next) {
            if ($next->getWeight() == $current->getWeight()) {
                return 0;
            }
            return ($current->getWeight() < $next->getWeight()) ? -1 : 1;
        });

        $template
            ->setId($response['id'])
            ->setName($response['name'])
            ->setOriginalProjectId($response['original_moov_id'])
            ->setThumbnail(!key_exists('thumb', $response) ? null : $response['thumb'])
            ->setPreview(!key_exists('preview', $response) ? null : $response['preview'])
            ->setVariables($variables)
        ;

        return $template;
    }
}
