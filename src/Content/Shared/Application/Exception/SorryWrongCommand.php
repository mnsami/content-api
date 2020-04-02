<?php
declare(strict_types=1);

namespace Content\Shared\Application\Exception;

class SorryWrongCommand extends \InvalidArgumentException
{
    public function __construct($message = null)
    {
        $message = $message ?? 'Wrong command passed to handler.';

        parent::__construct($message);
    }
}
