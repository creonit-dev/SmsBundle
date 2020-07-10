<?php

namespace Creonit\SmsBundle\Transport;


use Creonit\SmsBundle\Message\SmsMessage;
use Psr\Log\LoggerInterface;

class LoggerTransport extends AbstractSmsTransport
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        parent::__construct();

        $this->logger = $logger;
    }

    public function send(SmsMessage $message)
    {
        foreach ($message->getTo() as $phone) {
            $this->logger->info("Send SMS to {$phone}", [
                'content' => $message->getContent(),
            ]);
        }
    }

    protected function validateConfiguration()
    {
    }
}
