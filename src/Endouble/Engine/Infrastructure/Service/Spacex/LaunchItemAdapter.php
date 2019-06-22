<?php
declare(strict_types=1);

namespace Endouble\Engine\Infrastructure\Service\Spacex;

use Endouble\Engine\Domain\Model\Item\Item;
use Endouble\Engine\Infrastructure\Service\ItemAdapter;
use Endouble\Engine\Infrastructure\Service\ItemTranslator;
use GuzzleHttp\Client;

class LaunchItemAdapter implements ItemAdapter
{
    private $client;

    private const launches_endpoint = "/launches";

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $year
     * @param int $limit
     * @return Item[]
     */
    public function toItems(string $year, int $limit): array
    {
        $response = $this->client->get(self::launches_endpoint);

        $items = [];

        if (200 === $response->getStatusCode()) {
            $items = (new ItemTranslator())->toItemsFromLaunch(json_decode($response->getBody()), true);
        }

        return $items;
    }
}
