<?php

namespace AppBundle\Command;

use Endouble\Engine\Application\CreateItemsFromPastLaunches\CreateItemsFromPastLaunchesCommand;
use Endouble\Engine\Application\CreateItemsFromPastLaunches\CreateItemsFromPastLaunchesCommandHandler;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetAllSpacexPastLaunchesCommand extends ContainerAwareCommand
{
    private const YEAR_ARG = "year";
    private const LIMIT_ARG = "limit";

    protected function configure()
    {
        $this
            ->setName('get-all-spacex-past-launches')
            ->setDescription('Create Items and saves them from Spacex past launches')
            ->addArgument(self::YEAR_ARG, InputArgument::OPTIONAL, 'The year to filter past launches i.e. 2018')
            ->addArgument(self::LIMIT_ARG, InputArgument::OPTIONAL, 'Limit the results returned.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $year = $input->getArgument(self::YEAR_ARG) ?? 0;
        $limit = $input->getArgument(self::LIMIT_ARG) ?? 0;

        /** @var CreateItemsFromPastLaunchesCommandHandler $getAllPastLaunchesService */
        $getAllPastLaunchesService = $this->getContainer()->get('endouble.application.get_all_spacex_past_launches');
        $itemIds = $getAllPastLaunchesService->handle(
            new CreateItemsFromPastLaunchesCommand($year, $limit)
        );

        $output->writeln($itemIds->toArray());
    }
}
