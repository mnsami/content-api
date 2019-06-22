<?php
declare(strict_types=1);

namespace Endouble\Engine\Infrastructure\Service;

use Endouble\Engine\Domain\Model\Item\Item;
use Endouble\Engine\Domain\Model\Item\ItemService;

class TranslatingItemService implements ItemService
{
    /** @var ItemAdapter */
    private $itemAdapter;

    public function __construct(ItemAdapter $itemAdapter)
    {
        $this->itemAdapter = $itemAdapter;
    }

    /**
     * @inheritDoc
     */
    public function itemFrom(string $link, \DateTimeImmutable $date, string $details, int $number, string $source): Item
    {
        // TODO: Implement itemFrom() method.
    }
}
