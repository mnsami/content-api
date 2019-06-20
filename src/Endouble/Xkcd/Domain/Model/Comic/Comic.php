<?php
declare(strict_types=1);

namespace Endouble\Xkcd\Domain\Model\Comic;

use Endouble\Shared\Domain\Model\Uri;

final class Comic
{
    /** @var ComicId */
    private $comicId;

    /** @var Uri */
    private $imageUrl;

    /** @var ComicTitle */
    private $title;


    private $altText;

    /** @var \DateTimeImmutable */
    private $publishDate;

    /** @var Uri */
    private $link;
}
