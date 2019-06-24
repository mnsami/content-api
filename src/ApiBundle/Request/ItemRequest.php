<?php
declare(strict_types=1);

namespace ApiBundle\Request;

use Endouble\Engine\Application\GetItemsFromComics\GetItemsFromComicsCommand;
use Endouble\Engine\Application\GetItemsFromSpaceLaunches\GetItemsFromSpaceLaunchesCommand;
use Endouble\Engine\Domain\Model\Item\Source;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ItemRequest
{
    /** @var string */
    private $sourceId;

    /** @var int */
    private $year;

    /** @var int */
    private $limit;

    public function __construct(string $sourceId, int $year, int $limit)
    {
        if (empty($sourceId)) {
            throw new BadRequestHttpException('SourceId can not be empty.');
        }

        if ($year < 0) {
            throw new BadRequestHttpException('year can not be negative value.');
        }

        if ($limit < 0) {
            throw new BadRequestHttpException('Limit can not be negative or zero value.');
        }

        $this->sourceId = $sourceId;
        $this->year = $year;
        $this->limit = $limit;
    }

    public function isForSpace(): bool
    {
        return ($this->sourceId === Source::SPACE);
    }

    public function isForComics(): bool
    {
        return ($this->sourceId === Source::COMICS);
    }

    public function getCommand()
    {
        if ($this->sourceId === Source::SPACE) {
            return new GetItemsFromSpaceLaunchesCommand($this->year, $this->limit);
        } elseif ($this->sourceId === Source::COMICS) {
            return new GetItemsFromComicsCommand($this->year, $this->limit);
        }

        throw new BadRequestHttpException('SourceId not supported.');
    }

    public function sourceId(): string
    {
        return $this->sourceId;
    }

    public function year(): int
    {
        return $this->year;
    }

    public function limit(): int
    {
        return $this->limit;
    }

    public static function createFromArray(array $payload): ItemRequest
    {
        $year = intval($payload['year'] ?? 0);
        $limit = intval($payload['limit'] ?? 0);
        return new self(
            $payload['sourceId'],
            $year,
            $limit
        );
    }
}
