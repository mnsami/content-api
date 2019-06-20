<?php
declare(strict_types=1);

namespace Endouble\Spacex\Domain\Model;

use Ramsey\Uuid\Uuid;

final class LaunchId
{
    /** @var string */
    private $id;

    public function __construct(?string $id = null)
    {
        $this->id = null === $id ? Uuid::uuid4()->toString() : $id;
    }

    public function equals(LaunchId $playerId)
    {
        return $this->id === (string) $playerId;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
