<?php
declare(strict_types=1);

namespace Endouble\Spacex\Domain\Model\Launch;

interface LaunchRepository
{
    /**
     * @param Launch $launch
     * @return void
     */
    public function add(Launch $launch);

    /**
     * @param LaunchId $launchId
     * @return null|Launch
     */
    public function ofId(LaunchId $launchId): ?Launch;

    /**
     * @return LaunchId
     */
    public function nextIdentity(): LaunchId;

    /**
     * @return Launch[]
     */
    public function launches(): array;
}
