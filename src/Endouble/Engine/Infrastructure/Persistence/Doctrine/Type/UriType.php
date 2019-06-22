<?php
declare(strict_types=1);

namespace Endouble\Engine\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Types\GuidType;
use Endouble\Shared\Domain\Model\Uri;

class UriType extends GuidType
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