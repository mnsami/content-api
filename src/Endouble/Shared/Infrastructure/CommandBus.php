<?php
declare(strict_types=1);

namespace Endouble\Shared\Infrastructure;

interface CommandBus
{
    /**
     * @param Command $command
     *
     * @throws \Throwable
     *
     * @return mixed
     */
    public function execute(Command $command);
}
