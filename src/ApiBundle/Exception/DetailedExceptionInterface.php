<?php
declare(strict_types=1);

namespace ApiBundle\Exception;

interface DetailedExceptionInterface
{
    public function getDetailedMessage();
}
