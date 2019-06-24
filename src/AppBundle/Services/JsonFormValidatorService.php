<?php
declare(strict_types=1);

namespace AppBundle\Services;

use AppBundle\Exception\InvalidFormException;
use AppBundle\Exception\JsonSchemaNotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class JsonFormValidatorService
{
    private $jsonSchemaValidator;

    public function __construct($jsonSchemaValidator)
    {
        $this->jsonSchemaValidator = $jsonSchemaValidator;
    }

    public function assertValidJobSchema($requestContent, $action)
    {
        $data = '' === $requestContent ? new \stdClass() : json_decode($requestContent, false);

        if (null === $data) {
            throw new BadRequestHttpException('Unable to parse JSON.');
        }

        $schemaName = $this->getSchemaName($action);
        if (false === $this->jsonSchemaValidator->validate($data, $schemaName)) {
            throw new InvalidFormException('Validation failed', $this->jsonSchemaValidator->getErrorMessages());
        }

        return true;
    }

    private function getSchemaName($action)
    {
        $actionSchemaMap = $this->getActionSchemaMap();
        if (array_key_exists($action, $actionSchemaMap)) {
            return $actionSchemaMap[$action];
        }

        throw new JsonSchemaNotFoundException("There is no JSON schema found for '{$action}'.");
    }

    private function getActionSchemaMap()
    {
        return array(
            'create_player' => 'player',
            'game' => 'game'
        );
    }
}
