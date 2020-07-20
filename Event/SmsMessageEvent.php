<?php

namespace Creonit\SmsBundle\Event;

use Creonit\SmsBundle\Message\SmsMessage;
use Symfony\Contracts\EventDispatcher\Event;

abstract class SmsMessageEvent extends Event
{
    /**
     * @var SmsMessage
     */
    protected $message;

    public function __construct(SmsMessage $message)
    {
        $this->message = $message;
    }

    /**
     * @return SmsMessage
     */
    public function getMessage(): SmsMessage
    {
        return $this->message;
    }

    /**
     * @param SmsMessage $message
     *
     * @return $this
     */
    public function setMessage(SmsMessage $message)
    {
        $this->message = $message;
        return $this;
    }
}