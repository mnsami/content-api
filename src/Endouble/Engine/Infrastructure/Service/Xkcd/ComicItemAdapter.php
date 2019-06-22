<?php
declare(strict_types=1);

namespace Endouble\Engine\Infrastructure\Service\Xkcd;

use Endouble\Engine\Domain\Model\Item\Item;
use Endouble\Engine\Infrastructure\Service\ItemAdapter;
use GuzzleHttp\Client;

class ComicItemAdapter implements ItemAdapter
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Item[]
     */
    public function toItems(): array
    {
        // TODO: Implement toItems() method.
    }
}
