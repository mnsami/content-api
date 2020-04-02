<?php
declare(strict_types=1);

namespace Content\Engine\Infrastructure\Service\XkcdAdapter;

use Content\Engine\Domain\Model\Item\Item;
use Content\Engine\Infrastructure\Service\ItemTranslator;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class HttpComicAdapter implements ComicAdapter
{
    private const BASE_POINT = "https://xkcd.com";
    private const ARCHIVE_URL = "https://xkcd.com/archive/";

    private const FIRST_COMIC = "/1/info.0.json";
    private const LATEST_COMIC = "/info.0.json";
    private const ONE_COMIC = "/%s/info.0.json";

    /** @var Client */
    private $client;

    private $crawler;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->crawler = new Crawler();
        $this->crawler->add(file_get_contents(self::ARCHIVE_URL));
    }

    private function buildUrl(string $endpoint): string
    {
        return self::BASE_POINT . $endpoint;
    }

    /**
     * @inheritDoc
     */
    public function toItemsFromComics(int $year = 0, int $limit = 0): array
    {
        $params = [];
        $filter = '//div[@id="middleContainer"]/a';
        if ($year !== 0) {
            $filter .= '[contains(@title, "' . $year . '")]';
        }

        if ($limit !== 0) {
            $params['limit'] = $limit;
        }

        $comics = $this->crawler->filterXPath($filter);
        if ($limit !== 0) {
            $comics = $comics->slice(0, $limit);
        }

        $comics = $comics->extract(['href', 'title']);

        $items = [];

        foreach ($comics as $comic) {
            $id = str_replace('/', '', $comic[0]);
            $response = $this->client->get(
                $this->buildUrl(
                    sprintf(self::ONE_COMIC, $id)
                )
            );

            if (200 === $response->getStatusCode()) {
                $body = $response->getBody()->getContents();
                $items[] = (new ItemTranslator())->toItemFromComic(
                    json_decode($body, true)
                );
            }
        }

        return $items;
    }

    public function getFirstComic(): array
    {
        $response = $this->client->get(
            $this->buildUrl(self::FIRST_COMIC)
        );

        $firstComic = null;
        if (200 === $response->getStatusCode()) {
            $firstComic = json_decode(
                $response->getBody()->getContents(),
                true
            );
        }

        return $firstComic;
    }

    public function getLastComic(): array
    {
        $response = $this->client->get(
            $this->buildUrl(self::LATEST_COMIC)
        );

        $lastComic = null;
        if (200 === $response->getStatusCode()) {
            $lastComic = json_decode(
                $response->getBody()->getContents(),
                true
            );
        }

        return $lastComic;
    }

    /**
     * @return Item
     */
    public function toItemFromLatestComic(): Item
    {
        $response = $this->client->get(
            $this->buildUrl(self::LATEST_COMIC)
        );

        $firstComic = null;
        if (200 === $response->getStatusCode()) {
            $body = json_decode(
                $response->getBody()->getContents(),
                true
            );
            $firstComic = (new ItemTranslator())->toItemFromComic(
                $body
            );
        }

        return $firstComic;
    }
}
