<?php
declare(strict_types=1);

namespace Endouble\Engine\Application\GetItemsFromComics;

use Endouble\Engine\Application\ItemsListResponseDto;
use Endouble\Engine\Domain\Model\Item\ItemService;
use Endouble\Engine\Domain\Model\Item\Source;
use Endouble\Shared\Application\Exception\SorryWrongCommand;
use Endouble\Shared\Infrastructure\Command;
use Endouble\Shared\Infrastructure\CommandHandler;
use Endouble\Shared\Infrastructure\DataTransformer;
use Psr\Cache\CacheItemPoolInterface;

class GetItemsFromComicsCommandHandler implements CommandHandler
{
    /** @var ItemService */
    private $itemService;

    /** @var CacheItemPoolInterface */
    private $cacheItemPool;

    public function __construct(
        ItemService $itemService,
        CacheItemPoolInterface $cacheItemPool
    ) {
        $this->itemService = $itemService;
        $this->cacheItemPool = $cacheItemPool;
    }

    /**
     * Command class name
     *
     * @return string
     */
    public function handles(): string
    {
        return GetItemsFromComicsCommand::class;
    }

    /**
     * @param Command $command
     * @return DataTransformer
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function handle(Command $command): DataTransformer
    {
        if (!$command instanceof GetItemsFromComicsCommand) {
            throw new SorryWrongCommand('not support command ' . get_class($command));
        }

        $items = [];
        $key = Source::createXkcdSource() . "_{$command->year()}_{$command->limit()}";
        $cachedItem = $this->cacheItemPool->getItem($key);
        if (!$cachedItem->isHit()) {
            $items = $this->itemService->itemsFromComics(
                $command->year(),
                $command->limit()
            );

            $cachedItem->set($items);
            $this->cacheItemPool->save($cachedItem);
        } else {
            $items = $cachedItem->get();
        }

        return new ItemsListResponseDto(...$items);
    }
}
