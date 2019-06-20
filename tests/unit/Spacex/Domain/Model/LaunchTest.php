<?php
declare(strict_types=1);

namespace Endouble\UnitTests\Spacex\Domain\Model;

use Endouble\Shared\Domain\Model\Details;
use Endouble\Shared\Domain\Model\Uri;
use Endouble\Spacex\Domain\Model\Launch\FlightNumber;
use Endouble\Spacex\Domain\Model\Launch\Launch;
use Endouble\Spacex\Domain\Model\Launch\LaunchId;
use Endouble\Spacex\Domain\Model\Launch\MissionName;
use PHPUnit\Framework\TestCase;

class LaunchTest extends TestCase
{
    public function testLaunchCreatedSuccessfully()
    {
        $launch = new Launch(
            new LaunchId(),
            new FlightNumber(1),
            new Uri('http://example.com'),
            new Details('something details'),
            new \DateTimeImmutable(),
            new MissionName('mission 1')
        );

        self::assertEquals('something details', $launch->details());
        self::assertEquals(1, $launch->flightNumber()->value());
        self::assertInstanceOf(LaunchId::class, $launch->id());
    }
}
