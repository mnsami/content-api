<?php
declare(strict_types=1);

namespace Endouble\Spacex\Domain\Model\Launch;

final class FlightNumber
{
    /** @var int */
    private $flightNumber;

    public function __construct(int $flightNumber)
    {
        $this->flightNumber = $flightNumber;
    }

    public function value(): int
    {
        return $this->flightNumber;
    }
}
