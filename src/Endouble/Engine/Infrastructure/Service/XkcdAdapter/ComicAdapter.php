<?php
declare(strict_types=1);

namespace Endouble\Engine\Infrastructure\Service\XkcdAdapter;

use Endouble\Engine\Domain\Model\Item\Item;

interface ComicAdapter
{
    /**
     * @return Item[]
     */
    public function toItemsFromComics(): array;

    /**
     * @return Item
     */
    public function toItemFromLatestComic(): Item;
}
