<?php
declare(strict_types=1);

namespace Endouble\Engine\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Endouble\Engine\Domain\Model\Item\Name;

class NameType extends StringType
{
    private const NAME = "Name";
    private const NAMESPACE = "Endouble\Engine\Domain\Model\Item";

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Name($value);
    }

    public function getName()
    {
        return self::NAME;
    }

    protected function getNamespace()
    {
        return self::NAMESPACE;
    }
}
