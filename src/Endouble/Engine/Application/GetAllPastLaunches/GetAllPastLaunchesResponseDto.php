<?php
declare(strict_types=1);

namespace Endouble\Engine\Application\GetAllPastLaunches;

use Endouble\Engine\Domain\Model\Item\Item;
use Endouble\Shared\Application\DataTransformer;

final class GetAllPastLaunchesResponseDto implements DataTransformer
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
        // TODO: Implement toArray() method.
    }
}
