<?php
declare(strict_types=1);

namespace ApiBundle\Services;

use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

class JsonSchemaFormValidatorService
{
    private $validator;
    private $schemaStorage;

    private $baseDir;

    private $lastValidationErrorMessages = array();

    public function __construct($schemasBasedir = null)
    {
        if (!$schemasBasedir) {
            $schemasBasedir = 'file://'.realpath(__DIR__ . '/../Resources/json_schemas');
        }

        $this->baseDir = $schemasBasedir;

        $this->schemaStorage = new SchemaStorage();
        $this->validator = new Validator(new Factory($this->schemaStorage));
    }

    public function validate($data, $schemaName)
    {
        $this->lastValidationErrorMessage = array();

        $schema = $this->schemaStorage->getUriRetriever()->retrieve($this->baseDir.'/'.$schemaName.'.schema');
        // Resolve the references
        // This modifies the $schema object
        $this->schemaStorage->getUriResolver()->resolve($this->baseDir.'/'.$schemaName.'.schema');

        // Validate
        $this->validator->check($data, $schema);
        if (!$this->validator->isValid()) {
            foreach ($this->validator->getErrors() as $error) {
                $this->lastValidationErrorMessages[$error['property']]
                    = sprintf('[%s] %s', $error['property'], $error['message']);
            }

            return false;
        } else {
            return true;
        }
    }

    public function getErrorMessages()
    {
        return $this->lastValidationErrorMessages;
    }
}
