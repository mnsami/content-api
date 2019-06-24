<?php
declare(strict_types=1);

namespace ApiBundle\Request;

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
        $this->sourceId = $sourceId;
        $this->year = $year;
        $this->limit = $limit;
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
