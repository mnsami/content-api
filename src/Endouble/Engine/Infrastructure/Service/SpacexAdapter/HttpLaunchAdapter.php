<?php
declare(strict_types=1);

namespace Endouble\Engine\Infrastructure\Service\SpacexAdapter;

use Endouble\Engine\Domain\Model\Item\Item;
use Endouble\Engine\Infrastructure\Service\ItemTranslator;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

class HttpLaunchAdapter implements LaunchAdapter
{
    private const BASE_POINT = "https://api.spacexdata.com/v3";

    private const QUERY_LAUNCH_YEAR = 'launch_year';
    private const QUERY_LIMIT = 'limit';

    private const LAUNCHES = "/launches";
    private const PAST_LAUNCHES = self::LAUNCHES . "/past";
    private const UPCOMING_LAUNCHES = self::LAUNCHES . '/upcoming';
    private const LATEST_LAUNCH = self::LAUNCHES . '/latest';
    private const NEXT_LAUNCH = self::LAUNCHES . '/next';

    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    private function buildUrl(string $endpoint): string
    {
        return self::BASE_POINT . $endpoint;
    }

    public function toItemsFromLaunches(int $year = 0, int $limit = 0): array
    {
        $params = [];
        if ($year !== 0) {
            $params[self::QUERY_LAUNCH_YEAR] = $year;
        }

        if ($limit !== 0) {
            $params[self::QUERY_LIMIT] = $limit;
        }

        $response = $this->client->get(
            $this->buildUrl(self::LAUNCHES),
            [
                'query' => $params
            ]
        );

        $items = [];
        if (Response::HTTP_OK === $response->getStatusCode()) {
            $body = $response->getBody()->getContents();
            $items = (new ItemTranslator())->toItemsFromLaunches(
                json_decode($body, true)
            );
        }

        return $items;
    }

    /**
     * @param int $year
     * @param int $limit
     * @return array
     */
    public function toItemsFromPastLaunches(int $year = 0, int $limit = 0): array
    {
        $params = [];
        if ($year !== 0) {
            $params[self::QUERY_LAUNCH_YEAR] = $year;
        }

        if ($limit !== 0) {
            $params[self::QUERY_LIMIT] = $limit;
        }

        $response = $this->client->get(
            $this->buildUrl(self::PAST_LAUNCHES),
            [
                'query' => $params
            ]
        );

        $items = [];
        if (Response::HTTP_OK === $response->getStatusCode()) {
            $body = $response->getBody()->getContents();
            $items = (new ItemTranslator())->toItemsFromLaunches(
                json_decode($body, true)
            );
        }

        return $items;
    }

    /**
     * @param int $year
     * @param int $limit
     * @return array
     */
    public function toItemsFromUpcomingLaunches(int $year = 0, int $limit = 0): array
    {
        $params = [];
        if ($year !== 0) {
            $params[self::QUERY_LAUNCH_YEAR] = $year;
        }

        if ($limit !== 0) {
            $params[self::QUERY_LIMIT] = $limit;
        }

        $response = $this->client->get(
            $this->buildUrl(self::UPCOMING_LAUNCHES),
            [
                'query' => $params
            ]
        );

        $items = [];
        if (Response::HTTP_OK === $response->getStatusCode()) {
            $items = (new ItemTranslator())->toItemsFromLaunches(
                json_decode($response->getBody(), true)
            );
        }

        return $items;
    }

    /**
     * @return Item | null
     */
    public function toItemFromLatestLaunch(): ?Item
    {
        $response = $this->client->get(
            $this->buildUrl(self::LATEST_LAUNCH)
        );

        $item = null;
        if (Response::HTTP_OK === $response->getStatusCode()) {
            $item = (new ItemTranslator())->toItemFromLaunch(
                json_decode($response->getBody(), true)
            );
        }

        return $item;
    }

    /**
     * @return Item | null
     */
    public function toItemFromNextLaunch(): ?Item
    {
        $response = $this->client->get(
            $this->buildUrl(self::NEXT_LAUNCH)
        );

        $item = null;
        if (Response::HTTP_OK === $response->getStatusCode()) {
            $item = (new ItemTranslator())->toItemFromLaunch(
                json_decode($response->getBody(), true)
            );
        }

        return $item;
    }
}
