<?php
declare(strict_types=1);

namespace Endouble\Spacex\Domain\Model\Launch;

use Endouble\Shared\Domain\Model\Exception\SorryValidationError;

final class MissionName
{
    /** @var string */
    private $missionName;

    public function __construct(string $missionName)
    {
        if (empty($missionName)) {
            throw new SorryValidationError('MissionName can not be empty.');
        }
        $this->missionName = $missionName;
    }

    public function __toString(): string
    {
        return $this->missionName;
    }
}
