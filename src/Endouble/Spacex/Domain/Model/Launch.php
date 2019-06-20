<?php
declare(strict_types=1);

namespace Endouble\Spacex\Domain\Model;

use Endouble\Shared\Domain\Model\Details;
use Endouble\Shared\Domain\Model\Uri;

final class Launch
{
    /** @var LaunchId */
    private $launchId;

    /** @var FlightNumber */
    private $flightNumber;

    /** @var Uri */
    private $link;

    /** @var Details */
    private $details;

    /** @var \DateTimeImmutable */
    private $launchDate;

    /** @var MissionName */
    private $missionName;

    public function __construct(
        LaunchId $launchId,
        FlightNumber $flightNumber,
        Uri $link,
        Details $details,
        \DateTimeImmutable $launchDate,
        MissionName $missionName
    ) {
        $this->launchId = $launchId;
        $this->flightNumber = $flightNumber;
        $this->link = $link;
        $this->details = $details;
        $this->launchDate = $launchDate;
        $this->missionName = $missionName;
    }

    public function id(): LaunchId
    {
        return $this->id();
    }

    public function missionName(): MissionName
    {
        return $this->missionName;
    }

    public function launchDate(): \DateTimeImmutable
    {
        return $this->launchDate;
    }

    public function details(): Details
    {
        return $this->details;
    }

    public function link(): Uri
    {
        return $this->link;
    }

    public function flightNumber(): FlightNumber
    {
        return $this->flightNumber;
    }
}
