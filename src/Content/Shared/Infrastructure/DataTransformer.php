<?php
declare(strict_types=1);

namespace Content\Shared\Infrastructure;

interface DataTransformer
{
    /**
     * @return array
     */
    public function toArray(): array;
}
