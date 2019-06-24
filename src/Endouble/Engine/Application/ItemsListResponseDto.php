<?php
declare(strict_types=1);

namespace Endouble\Engine\Application;

use Endouble\Engine\Domain\Model\Item\Item;
use Endouble\Shared\Infrastructure\DataTransformer;

final class ItemsListResponseDto implements DataTransformer
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
        $items = array_map(function (Item $item) {
            return [
                'name' => (string) $item->name(),
                'details' => (string) $item->details(),
                'link' => (string) $item->link(),
                'number' => $item->number()->value(),
                'date' => $item->date()->format('Y-m-d')
            ];
        }, $this->items);

        return $items;
    }


}
