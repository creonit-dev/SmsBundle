<?php

namespace Creonit\SmsBundle\Event;

use Creonit\SmsBundle\Message\SmsMessage;
use Symfony\Contracts\EventDispatcher\Event;

abstract class SmsMessageEvent extends Event
{
    protected SmsMessage $message;

    public function __construct(SmsMessage $message)
    {
        $this->message = $message;
    }

    public function getMessage(): SmsMessage
    {
        return $this->message;
    }

    public function setMessage(SmsMessage $message): self
    {
        $this->message = $message;
        return $this;
    }
}
