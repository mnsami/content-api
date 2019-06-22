<?php
declare(strict_types=1);

namespace Endouble\Shared\Application\Exception;

class SorryWrongCommand extends \InvalidArgumentException
{
    public function __construct()
    {
        $message = 'Wrong command passed to handler.';

        parent::__construct($message);
    }
}
