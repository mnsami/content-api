<?php
declare(strict_types=1);

namespace Content\Engine\Infrastructure\Service\XkcdAdapter;

use Content\Engine\Domain\Model\Item\Item;

interface ComicAdapter
{
    /**
     * @param int $year
     * @param int $limit
     * @return Item[]
     */
    public function toItemsFromComics(int $year = 0, int $limit = 0): array;

    /**
     * @return Item
     */
    public function toItemFromLatestComic(): Item;
}
