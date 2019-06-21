<?php
declare(strict_types=1);

namespace Endouble\Xkcd\Domain\Model\Comic;

interface ComicRepository
{
    /**
     * @param Comic $comic
     * @return void
     */
    public function add(Comic $comic);

    /**
     * @param ComicId $comicId
     * @return null|Comic
     */
    public function ofId(ComicId $comicId): ?Comic;

    /**
     * @return ComicId
     */
    public function nextIdentity(): ComicId;

    /**
     * @return Comic[]
     */
    public function comics(): array;
}
