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
        $request = $event->getRequest();
        $event->getResponse()->headers->set('Content-Type', 'application/json');
        $content = $event->getResponse()->getContent();

        $sourceId = $request->query->get('sourceId');
        $year = $request->query->get('year');
        $limit = $request->query->get('limit', null);
        $requestPayload = [
            'sourceId' => $sourceId,
            'year' => $year
        ];

        if ($limit !== null) {
            $requestPayload['limit'] = $limit;
        }

        $contentPayload = [
            'meta' => [
                'request' => $requestPayload,
                'timestamp' => (new \DateTimeImmutable())->format(\DateTimeImmutable::ATOM)
            ],
            'data' => json_decode($content, true)
        ];
        $event->getResponse()->setContent(json_encode($contentPayload));
    }
}
