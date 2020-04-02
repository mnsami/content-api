<?php
declare(strict_types=1);

namespace Content\Engine\Application\GetItemsFromSpaceLaunches;

use Content\Engine\Application\ItemsListResponseDto;
use Content\Engine\Domain\Model\Item\ItemService;
use Content\Engine\Domain\Model\Item\Source;
use Content\Shared\Application\Exception\SorryWrongCommand;
use Content\Shared\Infrastructure\Command;
use Content\Shared\Infrastructure\CommandHandler;
use Content\Shared\Infrastructure\DataTransformer;
use Psr\Cache\CacheItemPoolInterface;

class GetItemsFromSpaceLaunchesCommandHandler implements CommandHandler
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
     * @inheritDoc
     */
    public function handles(): string
    {
        return GetItemsFromSpaceLaunchesCommand::class;
    }

    /**
     * @inheritDoc
     */
    public function handle(Command $command): DataTransformer
    {
        if (!$command instanceof GetItemsFromSpaceLaunchesCommand) {
            throw new SorryWrongCommand('not support command ' . get_class($command));
        }

        $items = [];
        $key = Source::createSpacexSource() . "_{$command->year()}_{$command->limit()}";
        $cachedItem = $this->cacheItemPool->getItem($key);
        if (!$cachedItem->isHit()) {
            $items = $this->itemService->itemsFromLaunches($command->year(), $command->limit());

            $cachedItem->set($items);
            $this->cacheItemPool->save($cachedItem);
        } else {
            $items = $cachedItem->get();
        }

        return new ItemsListResponseDto(...$items);
    }
}
