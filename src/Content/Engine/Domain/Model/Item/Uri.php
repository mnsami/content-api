<?php
declare(strict_types=1);

namespace Content\Engine\Domain\Model\Item;

use Content\Engine\Domain\Model\Item\Exception\SorryInvalidUrl;

final class Uri
{
    private $uri;

    private function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    private static function validate(string $uri)
    {
        if (empty($uri)) {
            return;
        }

        $sanitized = filter_var($uri, FILTER_SANITIZE_URL);

        if (filter_var($sanitized, FILTER_VALIDATE_URL) === false) {
            throw new SorryInvalidUrl('Invalid Url: ' . $uri);
        }
    }

    public static function createFromString(string $uri): Uri
    {
        self::validate($uri);

        return new self($uri);
    }

    public static function createEmpty(): Uri
    {
        return new self('');
    }

    public function __toString(): string
    {
        return $this->uri;
    }
}
