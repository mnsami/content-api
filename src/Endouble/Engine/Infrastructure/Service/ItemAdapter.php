<?php
declare(strict_types=1);

namespace Endouble\Engine\Infrastructure\Service;

use Endouble\Engine\Domain\Model\Item\Item;

interface ItemAdapter
{
    /**
     * @param string $year
     * @param int $limit
     * @return Item[]
     */
    public function toItems(string $year, int $limit): array;
}
