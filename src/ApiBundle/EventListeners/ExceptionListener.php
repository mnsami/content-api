<?php
declare(strict_types=1);

namespace ApiBundle\EventListeners;

use ApiBundle\Exception\InvalidFormException;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener implements LoggerAwareInterface
{
    private $logger = null;

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if ($this->logger) {
            $this->logger->warning(get_class($exception).': '.$exception->getMessage());
        }

        $response = new JsonResponse();
        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
        } else {
            $response->setStatusCode(500);
        }

        $data = array(
            'errorCode' => $response->getStatusCode(),
            'errorMessage' => $exception->getMessage(),
        );

        if ($exception instanceof InvalidFormException) {
            $data['errorDetails'] = $exception->getDetailedMessage();
        }

        $response->setData($data);

        $event->setResponse($response);
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
