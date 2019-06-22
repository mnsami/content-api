<?php
declare(strict_types=1);

namespace Endouble\Engine\Domain\Model\Item;

use Endouble\Spacex\Domain\Model\Launch\Launch;

interface ItemService
{
    /**
     * @param string $link
     * @param \DateTimeImmutable $date
     * @param string $details
     * @param int $number
     * @param string $source
     * @return Item
     */
    public function itemFrom(string $link, \DateTimeImmutable $date, string $details, int $number, string $source): Item;
}
