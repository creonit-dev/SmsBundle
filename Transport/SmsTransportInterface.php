<?php

namespace Creonit\SmsBundle\Transport;

use Creonit\SmsBundle\Message\SmsMessage;
use Creonit\SmsBundle\Transport\Error\SmsTransportError;

interface SmsTransportInterface
{
    public function send(SmsMessage $message);

    /**
     * @return SmsTransportError[]
     */
    public function getErrors(): array;

    public function init(array $configuration);
}
