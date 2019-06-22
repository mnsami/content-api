<?php

namespace AppBundle\Command;

use Endouble\Engine\Application\GetAllPastLaunches\GetAllPastLaunchesCommandHandler;
use Endouble\Engine\Application\GetAllPastLaunches\GetAllPastLaunchesCommand;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GetAllPastLaunches extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('get-all-past-launches')
            ->setDescription('...')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var GetAllPastLaunchesCommandHandler $getAllPastLaunchesService */
        $getAllPastLaunchesService = $this->getContainer()->get('endouble.application.get_all_past_launches');
        $getAllPastLaunchesService->handle(
            new GetAllPastLaunchesCommand(2018)
        );
    }

}
