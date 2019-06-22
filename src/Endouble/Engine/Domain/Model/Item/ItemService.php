<?php
declare(strict_types=1);

namespace Endouble\Engine\Domain\Model\Item;

interface ItemService
{
    /**
     * @param int $year
     * @param int $limit
     * @return array
     */
    public function itemsFromPastLaunches(int $year = 0, int $limit = 0): array;

    /**
     * @param int $year
     * @param int $limit
     * @return array
     */
    public function itemsFromUpcomingLaunches(int $year = 0, int $limit = 0): array;

    /**
     * @return Item
     */
    public function itemFromLatestLaunch(): Item;

    /**
     * @return Item
     */
    public function itemFromNextLaunch(): Item;

    /**
     * @return array
     */
    public function itemsFromComics(): array;

    /**
     * @return Item
     */
    public function itemFromLatestComic(): Item;
}
