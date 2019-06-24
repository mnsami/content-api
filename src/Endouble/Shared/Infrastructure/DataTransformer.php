<?php
declare(strict_types=1);

namespace Endouble\Shared\Infrastructure;

interface DataTransformer
{
    /**
     * @return array
     */
    public function toArray(): array;
}
