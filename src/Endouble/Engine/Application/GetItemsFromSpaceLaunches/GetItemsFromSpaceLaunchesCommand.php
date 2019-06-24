<?php
declare(strict_types=1);

namespace Endouble\Engine\Application\GetItemsFromSpaceLaunches;

use Endouble\Shared\Infrastructure\Command;

final class GetItemsFromSpaceLaunchesCommand implements Command
{
    /** @var int */
    private $year;

    /** @var int */
    private $limit;

    public function __construct(int $year = 0, int $limit = 0)
    {
        $this->year = $year;
        $this->limit = $limit;
    }

    public function year(): int
    {
        return $this->year;
    }

    public function limit(): int
    {
        return $this->limit;
    }
}
