<?php
declare(strict_types=1);

namespace Endouble\Engine\Domain\Model\Item;

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
