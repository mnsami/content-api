<?php
declare(strict_types=1);

namespace Endouble\Xkcd\Domain\Model\Comic;

use Ramsey\Uuid\Uuid;

final class ComicId
{
    /** @var string */
    private $id;

    public function __construct(?string $id = null)
    {
        $this->id = null === $id ? Uuid::uuid4()->toString() : $id;
    }

    public function equals(ComicId $comicId)
    {
        return $this->id === (string) $comicId;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
