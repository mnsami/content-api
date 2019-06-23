<?php
declare(strict_types=1);

namespace Endouble\Engine\Domain\Model\Item;

final class ItemNumber
{
    /** @var int */
    private $number;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public static function createFromString(string $number): ItemNumber
    {
        return new self(intval($number));
    }

    public function value(): int
    {
        return $this->number;
    }
}
