<?php
declare(strict_types=1);

namespace Endouble\Xkcd\Domain\Model\Comic;

use Endouble\Shared\Domain\Model\Exception\SorryValidationError;

final class Title
{
    /** @var string */
    private $title;

    public function __construct(string $title)
    {
        if (empty($title)) {
            throw new SorryValidationError('ComicTitle can not be empty.');
        }

        $this->title = $title;
    }

    public function __toString(): string
    {
        return $this->title;
    }
}
