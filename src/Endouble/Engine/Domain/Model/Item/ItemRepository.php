<?php
declare(strict_types=1);

namespace Endouble\Engine\Domain\Model\Item;

interface ItemRepository
{
    /**
     * @param Item $item
     * @return void
     */
    public function add(Item $item);

    /**
     * @param ItemId $itemId
     * @return null|Item
     */
    public function ofId(ItemId $itemId): ?Item;

    /**
     * @param ItemNumber $number
     * @param Source $source
     * @return Item|null
     */
    public function ofNumberAndSource(ItemNumber $number, Source $source): ?Item;

    /**
     * @return ItemId
     */
    public function nextIdentity(): ItemId;

    /**
     * @return Item[]
     */
    public function launches(): array;
}
