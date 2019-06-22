<?php
declare(strict_types=1);

namespace Endouble\Engine\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Types\GuidType;
use Endouble\Engine\Domain\Model\Item\ItemId;

class ItemIdType extends GuidType
{
    private const ITEM_ID = "ItemId";
    private const NAMESPACE = "Endouble\Engine\Domain\Model\Item";

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new ItemId($value);
    }

    public function getName()
    {
        return self::AQUARIUM_ID;
    }

    protected function getNamespace()
    {
        return self::NAMESPACE;
    }
}
