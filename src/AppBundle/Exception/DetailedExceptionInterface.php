<?php
declare(strict_types=1);

namespace AppBundle\Exception;

interface DetailedExceptionInterface
{
    public function getDetailedMessage();
}
