<?php
declare(strict_types=1);

namespace Endouble\Engine\Domain\Model\Item;

final class Number
{
    /** @var int */
    private $number;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function value(): int
    {
        return $this->number;
    }
}
