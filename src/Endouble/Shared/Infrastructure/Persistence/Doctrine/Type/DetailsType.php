<?php
declare(strict_types=1);

namespace Endouble\Shared\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Types\GuidType;
use Endouble\Shared\Domain\Model\Details;

class DetailsType extends GuidType
{
    private const DETAILS = "Details";
    private const NAMESPACE = "Endouble\Shared\Domain\Model";

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Details($value);
    }

    public function getName()
    {
        return self::DETAILS;
    }

    protected function getNamespace()
    {
        return self::NAMESPACE;
    }
}