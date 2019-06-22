<?php
declare(strict_types=1);

namespace Endouble\Engine\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class NumberType extends GuidType
{
    private const SOURCE = "Source";
    private const NAMESPACE = "Endouble\Engine\Domain\Model\Item";

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Source($value);
    }

    public function getName()
    {
        return self::SOURCE;
    }

    protected function getNamespace()
    {
        return self::NAMESPACE;
    }
}
