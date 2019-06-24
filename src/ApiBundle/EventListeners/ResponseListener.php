<?php
declare(strict_types=1);

namespace ApiBundle\EventListeners;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class ResponseListener implements LoggerAwareInterface
{
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        $event->getResponse()->headers->set('Content-Type', 'application/json');
    }
}
