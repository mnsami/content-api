<?php
declare(strict_types=1);

namespace Endouble\Engine\Infrastructure\Service;

use Endouble\Engine\Domain\Model\Item\Item;
use Endouble\Engine\Domain\Model\Item\ItemId;
use Endouble\Engine\Domain\Model\Item\ItemNumber;
use Endouble\Engine\Domain\Model\Item\Source;
use Endouble\Shared\Domain\Model\Details;
use Endouble\Shared\Domain\Model\Uri;

class ItemTranslator
{
    public function toItemsFromLaunches(array $launchesRepresentation): array
    {
        $items = [];
        foreach ($launchesRepresentation as $item) {
            $items[] = new Item(
                new ItemId(),
                Uri::createFromString($item['links']['wikipedia']),
                (new \DateTimeImmutable())->setTimestamp($item['launch_date_unix']),
                $item['details'] ? new Details($item['details']) : Details::createEmpty(),
                new ItemNumber($item['flight_number']),
                Source::createSpacexSource()
            );
        }

        return $items;
    }

    public function toItemFromLaunch(array $launchRepresentation): ?Item
    {
        var_dump($launchRepresentation);
    }
}
