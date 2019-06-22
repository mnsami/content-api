<?php
declare(strict_types=1);

namespace Endouble\Shared\Application;

interface DataTransformer
{
    /**
     * @return array
     */
    public function toArray(): array;
}
