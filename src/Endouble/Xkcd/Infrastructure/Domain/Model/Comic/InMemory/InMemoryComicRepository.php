<?php
declare(strict_types=1);

namespace Endouble\Xkcd\Infrastructure\Domain\Model\Comic\InMemory;

use Endouble\Xkcd\Domain\Model\Comic\Comic;
use Endouble\Xkcd\Domain\Model\Comic\ComicId;
use Endouble\Xkcd\Domain\Model\Comic\ComicRepository;

class InMemoryComicRepository implements ComicRepository
{
    private $comics = [];
    /**
     * @param Comic $comic
     * @return void
     */
    public function add(Comic $comic)
    {
        $this->comics[(string) $comic->id()] = $comic;
    }

    /**
     * @param ComicId $comicId
     * @return null|Comic
     */
    public function ofId(ComicId $comicId): ?Comic
    {
        if (!isset($this->comics[(string) $comicId])) {
            return null;
        }

        return $this->comics[(string) $comicId];
    }

    /**
     * @return ComicId
     */
    public function nextIdentity(): ComicId
    {
        return new ComicId();
    }

    /**
     * @return Comic[]
     */
    public function comics(): array
    {
        return $this->comics;
    }
}
