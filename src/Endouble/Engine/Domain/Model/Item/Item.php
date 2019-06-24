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

    /** @var ItemNumber */
    private $number;

    /** @var Name */
    private $name;

    /** @var Source */
    private $source;

    public function __construct(
        ItemId $itemId,
        Name $name,
        Uri $link,
        \DateTimeImmutable $date,
        Details $details,
        ItemNumber $number,
        Source $source
    ) {
        $this->itemId = $itemId;
        $this->name = $name;
        $this->link = $link;
        $this->date = $date;
        $this->details = $details;
        $this->number = $number;
        $this->source = $source;
    }

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

    public function number(): ItemNumber
    {
        return $this->number;
    }

    public function source(): Source
    {
        return $this->source;
    }

    public function name(): Name
    {
        return $this->name;
    }
}
