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
        if (empty($details)) {
            throw new SorryValidationError('Details can not be empty.');
        }

        $this->details = $details;
    }

    public function __toString(): string
    {
        return $this->details;
    }
}
