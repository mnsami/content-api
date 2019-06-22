<?php
declare(strict_types=1);

namespace Endouble\Shared\Domain\Model;

use Endouble\Shared\Domain\Model\Exception\SorryValidationError;

final class Details
{
    /** @var string */
    private $details;

    public function __construct(string $details)
    {
        $this->details = $details;
    }

    public static function createEmpty(): Details
    {
        return new self('');
    }

    public function __toString(): string
    {
        return $this->details;
    }
}
