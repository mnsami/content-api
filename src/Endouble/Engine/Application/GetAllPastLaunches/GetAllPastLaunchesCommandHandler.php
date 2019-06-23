<?php
declare(strict_types=1);

namespace Endouble\Engine\Application\GetAllPastLaunches;

use Endouble\Engine\Domain\Model\Item\Item;
use Endouble\Engine\Domain\Model\Item\ItemRepository;
use Endouble\Engine\Domain\Model\Item\ItemService;
use Endouble\Shared\Application\Command;
use Endouble\Shared\Application\CommandHandler;
use Endouble\Shared\Application\DataTransformer;
use Endouble\Shared\Application\Exception\SorryWrongCommand;

class GetAllPastLaunchesCommandHandler implements CommandHandler
{
    /** @var ItemService */
    private $itemService;

    /** @var ItemRepository */
    private $itemRepository;

    public function __construct(ItemService $itemService, ItemRepository $itemRepository)
    {
        $this->itemService = $itemService;
        $this->itemRepository = $itemRepository;
    }

    /**
     * @inheritDoc
     */
    public function handles(): string
    {
        return GetAllPastLaunchesCommand::class;
    }

    /**
     * @inheritDoc
     */
    public function handle(Command $command): DataTransformer
    {
        if (!$command instanceof GetAllPastLaunchesCommand) {
            throw new SorryWrongCommand();
        }

        $items = $this->itemService->itemsFromPastLaunches($command->year(), $command->limit());

        /** @var Item $item */
        foreach ($items as $item) {
            $this->itemRepository->add($item);
        }

        return new GetAllPastLaunchesResponseDto(...$items);
    }
}
