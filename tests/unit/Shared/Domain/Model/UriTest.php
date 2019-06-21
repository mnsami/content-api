<?php
declare(strict_types=1);

namespace Endouble\UnitTests\Shared\Domain\Model;

use Endouble\Shared\Domain\Model\Exception\SorryInvalidUrl;
use Endouble\Shared\Domain\Model\Uri;
use PHPUnit\Framework\TestCase;

class UriTest extends TestCase
{
    public function testItCreatesEmptySuccessfully()
    {
        $uri = Uri::createEmpty();
        self::assertInstanceOf(Uri::class, $uri);
        self::assertEquals("", (string) $uri);
    }

    public function testItThrowsValidationExceptionWithWrongUrl()
    {
        self::expectException(SorryInvalidUrl::class);
        $uri = Uri::createFromString("something");
    }
}
