<?php
declare(strict_types=1);

namespace Endouble\Engine\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;
use Endouble\Engine\Domain\Model\Item\ItemNumber;

class ItemNumberType extends IntegerType
{
    private const NUMBER = "ItemNumber";
    private const NAMESPACE = "Endouble\Engine\Domain\Model\Item";

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof ItemNumber) {
            return $value->value();
        }

        return $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return ItemNumber::createFromString($value);
    }

    public function getName()
    {
        return self::NUMBER;
    }

    protected function getNamespace()
    {
        return self::NAMESPACE;
    }
}
