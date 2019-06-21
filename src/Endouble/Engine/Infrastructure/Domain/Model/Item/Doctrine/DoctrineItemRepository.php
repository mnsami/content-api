<?php
declare(strict_types=1);

namespace Endouble\Engine\Infrastructure\Domain\Model\Item\Doctrine;

use Doctrine\ORM\EntityRepository;
use Endouble\Engine\Domain\Model\Item\Item;
use Endouble\Engine\Domain\Model\Item\ItemId;
use Endouble\Engine\Domain\Model\Item\ItemRepository;

class DoctrineItemRepository extends EntityRepository implements ItemRepository
{
    /**
     * @inheritDoc
     */
    public function add(Item $item)
    {
        $this->getEntityManager()->persist($item);
        $this->getEntityManager()->flush();
    }

    /**
     * @inheritDoc
     */
    public function ofId(ItemId $itemId): ?Item
    {
        return $this->getEntityManager()->find($itemId);
    }

    /**
     * @inheritDoc
     */
    public function nextIdentity(): ItemId
    {
        return new ItemId();
    }

    /**
     * @inheritDoc
     */
    public function launches(): array
    {
        return $this->findAll();
    }
}
