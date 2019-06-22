<?php
declare(strict_types=1);

namespace Endouble\Engine\Infrastructure\Service\XkcdAdapter;

use Endouble\Engine\Domain\Model\Item\Item;
use GuzzleHttp\ClientInterface;

class HttpComicAdapter implements ComicAdapter
{
    /** @var ClientInterface */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return Item[]
     */
    public function toItemsFromComics(): array
    {
        // TODO: Implement toItemsFromComics() method.
    }

    /**
     * @return Item
     */
    public function toItemFromLatestComic(): Item
    {
        // TODO: Implement toItemFromLatestComic() method.
    }
}
