<?php
declare(strict_types=1);

namespace Endouble\Xkcd\Domain\Model\Comic;

use Endouble\Shared\Domain\Model\Uri;

final class Comic
{
    /** @var ComicId */
    private $id;

    /** @var Uri */
    private $imageUrl;

    /** @var Title */
    private $title;

    /** @var AltText */
    private $altText;

    /** @var \DateTimeImmutable */
    private $publishDate;

    /** @var Uri */
    private $link;

    public function __construct(
        ComicId $comicId,
        Uri $imageUrl,
        Title $title,
        AltText $altText,
        \DateTimeImmutable $publishDate,
        Uri $link
    ) {
        $this->id = $comicId;
        $this->imageUrl = $imageUrl;
        $this->title = $title;
        $this->altText = $altText;
        $this->publishDate = $publishDate;
        $this->link = $link;
    }

    public function id(): ComicId
    {
        return $this->id;
    }

    public function imageUrl(): Uri
    {
        return $this->imageUrl;
    }

    public function link(): Uri
    {
        return $this->link;
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function altText(): AltText
    {
        return $this->altText;
    }

    public function publishDate(): \DateTimeImmutable
    {
        return $this->publishDate;
    }
}
