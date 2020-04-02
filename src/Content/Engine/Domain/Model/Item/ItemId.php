<?php
declare(strict_types=1);

namespace Content\Engine\Domain\Model\Item;

use Ramsey\Uuid\Uuid;

class ItemId
{
    /** @var string */
    private $id;

    public function __construct(?string $id = null)
    {
        $this->id = null === $id ? Uuid::uuid4()->toString() : $id;
    }

    public function equals(ItemId $itemId)
    {
        return $this->id === (string) $itemId;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
