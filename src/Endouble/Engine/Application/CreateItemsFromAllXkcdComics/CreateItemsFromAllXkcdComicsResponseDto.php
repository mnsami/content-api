<?php
declare(strict_types=1);

namespace Endouble\Engine\Application\CreateItemsFromAllXkcdComics;

use Endouble\Engine\Domain\Model\Item\Item;
use Endouble\Shared\Application\DataTransformer;

final class CreateItemsFromAllXkcdComicsResponseDto implements DataTransformer
{
    private $items;

    public function __construct(Item ...$items)
    {
        $this->items = $items;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $itemIds = array_map(function (Item $item) {
            return (string) $item->id();
        }, $this->items);

        return $itemIds;
    }
}
