<?php
declare(strict_types=1);

namespace Endouble\Shared\Domain\Model;

use Endouble\Shared\Domain\Model\Exception\SorryValidationError;

final class ImageUrl
{
    const NO_IMAGE = 'no-image';

    /** @var string */
    private $imageUrl;

    private function __construct(string $imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    public function __toString(): string
    {
        if ($this->hasNoImage()) {
            return '';
        }

        return $this->imageUrl;
    }

    public static function createFromString(string $imageUrl): ImageUrl
    {
        if (empty($imageUrl)) {
            return self::createEmpty();
        }

        self::validate($imageUrl);

        return new self($imageUrl);
    }

    public static function createEmpty(): ImageUrl
    {
        return new self(self::NO_IMAGE);
    }

    private static function validate(string $imageUrl)
    {
        if (empty($imageUrl)) {
            return self::createEmpty();
        }

        $parsedUrl = parse_url($imageUrl);

        if (!array_key_exists('scheme', $parsedUrl)) {
            throw new SorryValidationError('A scheme is missing from the image url.');
        }

        if (!array_key_exists('path', $parsedUrl)) {
            throw new SorryValidationError('A path is missing from the image url.');
        }

        if (!self::endsWithAllowedImageTypes($imageUrl)) {
            throw new SorryValidationError('The featured image is not an allowed image type.');
        }

        return new self($imageUrl);
    }

    private static function endsWithAllowedImageTypes(string $imageUrl): bool
    {
        $allowedImageTypes = ['png'];

        foreach ($allowedImageTypes as $imageType) {
            if ((mb_substr($imageUrl, -mb_strlen($imageType)) === $imageType)) {
                return true;
            }
        }

        return false;
    }

    private function hasNoImage(): bool
    {
        return self::NO_IMAGE === $this->imageUrl;
    }
}
