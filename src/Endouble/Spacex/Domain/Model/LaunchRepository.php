<?php
declare(strict_types=1);

namespace Endouble\Spacex\Domain\Model;

interface LaunchRepository
{
    /**
     * @param Launch $launch
     * @return void
     */
    public function add(Launch $launch);

    /**
     * @param LaunchId $launchId
     * @return null|LaunchId
     */
    public function ofId(LaunchId $launchId): ?LaunchId;

    /**
     * @return LaunchId
     */
    public function nextIdentity(): LaunchId;

    /**
     * @return Launch[]
     */
    public function launches(): array;
}
