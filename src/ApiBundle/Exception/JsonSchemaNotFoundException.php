<?php
declare(strict_types=1);

namespace ApiBundle\Exception;

class JsonSchemaNotFoundException extends BaseException
{
    protected $httpStatusCode = 404;
}
