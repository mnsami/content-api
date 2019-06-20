<?php
declare(strict_types=1);

namespace Endouble\Shared\Domain\Model;

use Endouble\Shared\Domain\Model\Exception\SorryInvalidUrl;
use Endouble\Shared\Domain\Model\Exception\SorryValidationError;

final class Uri
{
    private $uri;

    public function __construct(string $uri)
    {
        if (empty($uri)) {
            throw new SorryValidationError('Uri can not be empty.');
        }
        $sanitized = filter_var($uri, FILTER_SANITIZE_URL);

        if (filter_var($sanitized, FILTER_VALIDATE_URL) !== false) {
            throw new SorryInvalidUrl();
        }

        $this->uri = $uri;
    }

    public function __toString(): string
    {
        return $this->uri;
    }
}
