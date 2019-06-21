<?php
declare(strict_types=1);

namespace Endouble\Engine\Domain\Model\Item;

use Endouble\Engine\Domain\Model\Item\Exception\SorryInvalidSource;
use Endouble\Shared\Domain\Model\Exception\SorryValidationError;

final class Source
{
    /** @var string */
    private $source;

    const SPACEX = 'spacex';
    const XKCD = 'xkcd';

    private const VALID_SOURCES = [
        self::SPACEX,
        self::XKCD
    ];

    private function __construct(string $source)
    {
        $this->validate($source);

        $this->source = $source;
    }

    public function __toString(): string
    {
        return $this->source;
    }

    public static function createSpacexSource(): Source
    {
        return new self(self::SPACEX);
    }

    public static function createXkcdSource(): Source
    {
        return new self(self::XKCD);
    }

    private function validate(string $source)
    {
        if (empty($source)) {
            throw new SorryValidationError('Source can not be empty.');
        }

        if (!in_array($source, self::VALID_SOURCES)) {
            throw new SorryInvalidSource('Source type is not valid.');
        }
    }
}
