<?php
declare(strict_types=1);

namespace Endouble\Engine\Domain\Model\Item;

use Endouble\Shared\Domain\Model\Details;
use Endouble\Shared\Domain\Model\Uri;

final class Item
{
    /** @var ItemId */
    private $itemId;

    /** @var Uri */
    private $link;

    /** @var \DateTimeImmutable */
    private $date;

    /** @var Details */
    private $details;

    /** @var Number */
    private $number;

    public function id(): ItemId
    {
        return $this->itemId;
    }

    public function link(): Uri
    {
        return $this->link;
    }

    public function date(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function details(): Details
    {
        return $this->details;
    }

    public function number(): Number
    {
        return $this->number;
    }
}
