<?php

namespace AppBundle\Command;

use Endouble\Engine\Application\CreateItemsFromAllXkcdComics\CreateItemsFromAllXkcdComicsCommand as EngineCreateItemsFromAllXkcdComicsCommand;
use Endouble\Engine\Application\CreateItemsFromAllXkcdComics\CreateItemsFromAllXkcdComicsCommandHandler;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateItemsFromAllXkcdComicsCommand extends ContainerAwareCommand
{
    private const YEAR_ARG = "year";
    private const LIMIT_ARG = "limit";

    protected function configure()
    {
        $this
            ->setName('create-items-from-all-xkcd-comics')
            ->setDescription('Create Items and saves them from XKCD comics')
            ->addArgument(self::YEAR_ARG, InputArgument::OPTIONAL, 'The year to filter past launches i.e. 2018')
            ->addArgument(self::LIMIT_ARG, InputArgument::OPTIONAL, 'Limit the results returned.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $year = $input->getArgument(self::YEAR_ARG) ?? 0;
        $limit = $input->getArgument(self::LIMIT_ARG) ?? 0;

        try {
            /** @var CreateItemsFromAllXkcdComicsCommandHandler $createItemsFromAllXkcdComicsCommandHandler */
            $createItemsFromAllXkcdComicsCommandHandler = $this->getContainer()->get('endouble.application.create_items_from_all_xkcd_comics');
            $itemIds = $createItemsFromAllXkcdComicsCommandHandler->handle(
                new EngineCreateItemsFromAllXkcdComicsCommand($year, $limit)
            );
            $output->writeln($itemIds->toArray());
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
            exit(1);
        }
    }
}
