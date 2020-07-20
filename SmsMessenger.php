<?php

namespace Creonit\SmsBundle;


use Creonit\SmsBundle\Event\PostSendSmsMessageEvent;
use Creonit\SmsBundle\Event\PreSendSmsMessageEvent;
use Creonit\SmsBundle\Event\SmsEvents;
use Creonit\SmsBundle\Message\SmsMessage;
use Creonit\SmsBundle\Transport\SmsTransportInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class SmsMessenger implements MessageHandlerInterface
{
    protected SmsTransportInterface $transport;
    protected LoggerInterface $logger;
    protected EventDispatcherInterface $eventDispatcher;

    public function __construct(SmsTransportInterface $transport, LoggerInterface $logger, EventDispatcherInterface $eventDispatcher)
    {
        $this->transport = $transport;
        $this->logger = $logger;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __invoke(SmsMessage $message)
    {
        $this->eventDispatcher->dispatch(new PreSendSmsMessageEvent($message), SmsEvents::PRE_SEND);

        $this->transport->send($message);

        $this->eventDispatcher->dispatch(new PostSendSmsMessageEvent($message), SmsEvents::POST_SEND);

        foreach ($this->transport->getErrors() as $error) {
            $this->logger->error("Send SMS error: {$error->getMessage()}", $error->getContext());
        }
    }
}
