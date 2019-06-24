<?php
declare(strict_types=1);

namespace AppBundle\Exception;

class JsonSchemaNotFoundException extends BaseException
{
    protected $httpStatusCode = 404;
}
