<?php
declare(strict_types=1);

namespace Endouble\Engine\Infrastructure\Service\SpacexAdapter;

use Endouble\Engine\Domain\Model\Item\Item;

interface LaunchAdapter
{
    /**
     * @param int $year
     * @param int $limit
     * @return array
     */
    public function toItemsFromLaunches(int $year = 0, int $limit = 0): array;

    /**
     * @param int $year
     * @param int $limit
     * @return array
     */
    public function toItemsFromPastLaunches(int $year = 0, int $limit = 0): array;

    /**
     * @param int $year
     * @param int $limit
     * @return array
     */
    public function toItemsFromUpcomingLaunches(int $year = 0, int $limit = 0): array;

    /**
     * @return Item | null
     */
    public function toItemFromLatestLaunch(): ?Item;

    /**
     * @return Item | null
     */
    public function toItemFromNextLaunch(): ?Item;
}
