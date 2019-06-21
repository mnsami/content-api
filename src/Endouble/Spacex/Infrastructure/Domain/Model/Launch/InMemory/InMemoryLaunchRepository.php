<?php
declare(strict_types=1);

namespace Endouble\Spacex\Infrastructure\Domain\Model\Launch\InMemory;

use Endouble\Spacex\Domain\Model\Launch\Launch;
use Endouble\Spacex\Domain\Model\Launch\LaunchId;
use Endouble\Spacex\Domain\Model\Launch\LaunchRepository;

class InMemoryLaunchRepository implements LaunchRepository
{
    private $launches = [];
    /**
     * @param Launch $launch
     * @return void
     */
    public function add(Launch $launch)
    {
        $this->launches[(string) $launch->id()] = $launch;
    }

    /**
     * @param LaunchId $launchId
     * @return null|Launch
     */
    public function ofId(LaunchId $launchId): ?Launch
    {
        if (!isset($this->launches[(string) $launchId])) {
            return null;
        }

        return $this->launches[(string) $launchId];
    }

    /**
     * @return LaunchId
     */
    public function nextIdentity(): LaunchId
    {
        return new LaunchId();
    }

    /**
     * @return Launch[]
     */
    public function launches(): array
    {
        return $this->launches;
    }
}
