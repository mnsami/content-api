<?php
declare(strict_types=1);

namespace Endouble\Engine\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Platforms\MySqlPlatform;
use Doctrine\DBAL\Types\StringType;
use Endouble\Shared\Domain\Model\Uri;

class UriType extends StringType
{
    private const URI = "Uri";
    private const NAMESPACE = "Endouble\Engine\Domain\Model\Item";

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return Uri::createFromString($value);
    }

    public function getName()
    {
        return self::URI;
    }

    protected function getNamespace()
    {
        return self::NAMESPACE;
    }
}
