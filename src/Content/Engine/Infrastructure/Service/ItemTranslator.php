<?php
declare(strict_types=1);

namespace Content\Engine\Infrastructure\Service;

use Content\Engine\Domain\Model\Item\Details;
use Content\Engine\Domain\Model\Item\Item;
use Content\Engine\Domain\Model\Item\ItemId;
use Content\Engine\Domain\Model\Item\ItemNumber;
use Content\Engine\Domain\Model\Item\Name;
use Content\Engine\Domain\Model\Item\Source;
use Content\Engine\Domain\Model\Item\Uri;

class ItemTranslator
{
    public function toItemsFromLaunches(array $launchesRepresentation): array
    {
        $items = [];
        foreach ($launchesRepresentation as $item) {
            $uri
                = $item['links']['article_link'] ?
                    Uri::createFromString($item['links']['article_link']) : Uri::createEmpty();
            $items[] = new Item(
                new ItemId(),
                new Name($item['mission_name']),
                $uri,
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
        $details
            = $launchRepresentation['details'] ?
            new Details($launchRepresentation['details']) : Details::createEmpty();
        $uri
            = $launchRepresentation['links']['article_link'] ?
            Uri::createFromString($launchRepresentation['links']['article_link']) : Uri::createEmpty();
        $date = (new \DateTimeImmutable())
            ->setTimestamp($launchRepresentation['launch_date_unix']);
        return new Item(
            new ItemId(),
            new Name($launchRepresentation['mission_name']),
            $uri,
            $date,
            $details,
            new ItemNumber($launchRepresentation['flight_number']),
            Source::createSpacexSource()
        );
    }

    public function toItemFromComic(array $comicRepresentation): ?Item
    {
        $details
            = $comicRepresentation['alt'] ?
            new Details($comicRepresentation['alt']) : Details::createEmpty();
        $date = (new \DateTimeImmutable())->setDate(
            intval($comicRepresentation['year']),
            intval($comicRepresentation['month']),
            intval($comicRepresentation['day'])
        );
        return new Item(
            new ItemId(),
            new Name($comicRepresentation['title']),
            Uri::createFromString($comicRepresentation['link']),
            $date,
            $details,
            new ItemNumber($comicRepresentation['num']),
            Source::createXkcdSource()
        );
    }
}
