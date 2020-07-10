<?php

namespace Creonit\SmsBundle;


use Creonit\SmsBundle\Message\SmsMessage;
use Creonit\SmsBundle\Transport\SmsTransportInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SmsMessenger implements MessageHandlerInterface
{
    protected SmsTransportInterface $transport;
    protected LoggerInterface $logger;

    public function __construct(SmsTransportInterface $transport, LoggerInterface $logger)
    {
        $this->transport = $transport;
        $this->logger = $logger;
    }

    public function __invoke(SmsMessage $message)
    {
        $this->transport->send($message);

        foreach ($this->transport->getErrors() as $error) {
            $this->logger->error("Send SMS error: {$error->getMessage()}", $error->getContext());
        }
    }
}
