<?php
declare(strict_types=1);

namespace Endouble\Xkcd\Domain\Model\Comic;

use Endouble\Shared\Domain\Model\Exception\SorryValidationError;

final class AltText
{
    /** @var string */
    private $altText;

    public function __construct(string $altText)
    {
        if (empty($altText)) {
            throw new SorryValidationError('AltText can not be empty.');
        }

        $this->altText = $altText;
    }

    public function __toString(): string
    {
        return $this->altText;
    }
}
