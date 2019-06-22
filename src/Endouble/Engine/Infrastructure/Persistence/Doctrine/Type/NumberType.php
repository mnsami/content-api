<?php
declare(strict_types=1);

namespace Endouble\Engine\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;
use Endouble\Engine\Domain\Model\Item\Number;

class NumberType extends IntegerType
{
    private const NUMBER = "Number";
    private const NAMESPACE = "Endouble\Engine\Domain\Model\Item";

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->value();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Number($value);
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
