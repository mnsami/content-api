<?php
declare(strict_types=1);

namespace Content\Shared\Infrastructure;

interface CommandHandler
{
    /**
     * Command class name
     *
     * @return string
     */
    public function handles(): string;

    /**
     * @param Command $command
     * @return DataTransformer
     */
    public function handle(Command $command): DataTransformer;
}
