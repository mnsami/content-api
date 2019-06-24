<?php
declare(strict_types=1);

namespace AppBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class BaseException extends \Exception implements HttpExceptionInterface
{
    protected $httpStatusCode = 500;

    public function getStatusCode()
{
    return $this->httpStatusCode;
}

    public function getHeaders()
{
    return array();
}
}
