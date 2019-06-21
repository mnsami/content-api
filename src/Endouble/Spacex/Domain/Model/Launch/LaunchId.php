<?php
declare(strict_types=1);

namespace Endouble\Spacex\Domain\Model\Launch;

use Ramsey\Uuid\Uuid;

final class LaunchId
{
    /** @var string */
    private $id;

    public function __construct(?string $id = null)
    {
        $this->id = null === $id ? Uuid::uuid4()->toString() : $id;
    }

    public function equals(LaunchId $launchId)
    {
        return $this->id === (string) $launchId;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
