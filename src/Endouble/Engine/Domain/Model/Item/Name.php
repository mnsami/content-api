<?php
declare(strict_types=1);

namespace Endouble\Engine\Domain\Model\Item;

use Endouble\Shared\Domain\Model\Exception\SorryValidationError;

final class Name
{
    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        if (empty($name)) {
            throw new SorryValidationError('Name can not be empty.');
        }

        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
