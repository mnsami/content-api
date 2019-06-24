<?php
declare(strict_types=1);

namespace AppBundle\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class InvalidFormException extends BadRequestHttpException implements DetailedExceptionInterface
{
    protected $message = 'Validation Failed';
    protected $extraErrors;

    public function __construct($message, array $extraErrors = array())
    {
        $this->extraErrors = $extraErrors;

        parent::__construct($message);
    }

    public function getDetailedMessage()
    {
        return $this->getErrorMessages($this->extraErrors);
    }

    protected function getErrorMessages(array $extraErrors)
    {
        $errors = array();

        foreach ($extraErrors as $key => $error) {
            $errors[$key] = $error;
        }

        return $errors;
    }
}
