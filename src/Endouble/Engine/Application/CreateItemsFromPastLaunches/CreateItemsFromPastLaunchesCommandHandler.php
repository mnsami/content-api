<?php
declare(strict_types=1);

namespace Endouble\Engine\Application\CreateItemsFromPastLaunches;

use Endouble\Engine\Domain\Model\Item\ItemService;
use Endouble\Engine\Domain\Model\Item\Source;
use Endouble\Shared\Application\Command;
use Endouble\Shared\Application\CommandHandler;
use Endouble\Shared\Application\DataTransformer;
use Endouble\Shared\Application\Exception\SorryWrongCommand;
use Psr\Cache\CacheItemPoolInterface;

class CreateItemsFromPastLaunchesCommandHandler implements CommandHandler
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
        return CreateItemsFromPastLaunchesCommand::class;
    }

    /**
     * @inheritDoc
     */
    public function handle(Command $command): DataTransformer
    {
        if (!$command instanceof CreateItemsFromPastLaunchesCommand) {
            throw new SorryWrongCommand();
        }

        $items = [];
        $key = Source::createSpacexSource() . "_{$command->year()}_{$command->limit()}";
        $cachedItem = $this->cacheItemPool->getItem($key);
        if (!$cachedItem->isHit()) {
            $items = $this->itemService->itemsFromPastLaunches($command->year(), $command->limit());

            $cachedItem->set($items);
            $this->cacheItemPool->save($cachedItem);
        } else {
            $items = $cachedItem->get();
        }


        return new CreateItemsFromPastLaunchesResponseDto(...$items);
    }
}
