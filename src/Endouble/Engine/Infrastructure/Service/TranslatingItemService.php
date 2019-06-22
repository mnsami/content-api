<?php
declare(strict_types=1);

namespace Endouble\Engine\Infrastructure\Service;

use Endouble\Engine\Domain\Model\Item\Item;
use Endouble\Engine\Domain\Model\Item\ItemService;
use Endouble\Engine\Infrastructure\Service\SpacexAdapter\LaunchAdapter;
use Endouble\Engine\Infrastructure\Service\XkcdAdapter\ComicAdapter;

class TranslatingItemService implements ItemService
{
    /** @var LaunchAdapter */
    private $launchAdapter;

    /** @var ComicAdapter */
    private $comicAdapter;

    public function __construct(LaunchAdapter $launchAdapter, ComicAdapter $comicAdapter)
    {
        $this->launchAdapter = $launchAdapter;
        $this->comicAdapter = $comicAdapter;
    }

    /**
     * @inheritDoc
     */
    public function itemsFromPastLaunches(int $year = 0, int $limit = 0): array
    {
        return $this->launchAdapter->toItemsFromPastLaunches($year, $limit);
    }

    /**
     * @inheritDoc
     */
    public function itemsFromUpcomingLaunches(int $year = 0, int $limit = 0): array
    {
        return $this->launchAdapter->toItemsFromUpcomingLaunches($year, $limit);
    }

    /**
     * @inheritDoc
     */
    public function itemFromLatestLaunch(): Item
    {
        return $this->launchAdapter->toItemFromLatestLaunch();
    }

    /**
     * @inheritDoc
     */
    public function itemFromNextLaunch(): Item
    {
        return $this->launchAdapter->toItemFromNextLaunch();
    }

    /**
     * @inheritDoc
     */
    public function itemsFromComics(): array
    {
        // TODO: Implement itemsFromComics() method.
    }

    /**
     * @inheritDoc
     */
    public function itemFromLatestComic(): Item
    {
        // TODO: Implement itemFromLatestComic() method.
    }
}
